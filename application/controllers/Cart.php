<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Cart_model', 'Product_model', 'Order_model', 'Order_item_model']);

        // Wajib login
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    /**
     * Menampilkan isi keranjang belanja pengguna.
     * Mengambil data item dari Cart_model berdasarkan user ID dan merender view 'cart/index'.
     */
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Cart';
        $data['items'] = $this->Cart_model->getItems($userId);

        $this->render('cart/index', $data);
    }

    /**
     * Menambahkan produk ke dalam keranjang belanja.
     * Menerima ID produk, memvalidasi sesi pengguna, dan menyimpan data ke database melalui Cart_model.
     */
    public function add($productId)
    {
        $userId = $this->session->userdata('user_id');

        if ($productId && $userId) {
            $this->Cart_model->addOrUpdate($userId, $productId, 1);
            $this->session->set_flashdata('success', 'Item added to cart');
        }

        $ref = $this->input->server('HTTP_REFERER') ?: site_url('products');
        redirect($ref);
    }

    /**
     * Memperbarui jumlah item dalam keranjang belanja.
     * Menerima input array quantity dari form dan mengupdate data di database.
     */
    public function update()
    {
        $userId = $this->session->userdata('user_id');
        $quantities = $this->input->post('quantity');

        if ($quantities && $userId) {
            foreach ($quantities as $productId => $qty) {
                $this->Cart_model->updateQuantity($userId, $productId, (int) $qty);
            }
            $this->session->set_flashdata('success', 'Cart updated');
        }

        redirect('cart');
    }

    /**
     * Menghapus item tertentu dari keranjang belanja.
     * Menerima product ID dan menghapus data terkait dari database keranjang pengguna.
     */
    public function remove($productId)
    {
        $userId = $this->session->userdata('user_id');

        if ($userId && $productId) {
            $this->Cart_model->removeItem($userId, $productId);
            $this->session->set_flashdata('success', 'Item removed');
        }

        redirect('cart');
    }

    /**
     * Menampilkan halaman checkout.
     * Memungkinkan pengguna mengisi data pengiriman dan memilih metode pembayaran.
     */
    public function checkout()
    {
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Checkout';
        $data['items'] = $this->Cart_model->getItems($userId);
        
        // Cek jika cart kosong
        if (empty($data['items'])) {
            $this->session->set_flashdata('error', 'Keranjang belanja Anda kosong.');
            redirect('products');
        }

        // Hitung total
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $data['total'] = $total;

        $this->render('cart/checkout', $data);
    }

    /**
     * Memproses checkout pesanan dari form modal.
     * Memvalidasi input pengguna, membuat pesanan baru di database, dan mengarahkan ke halaman pembayaran.
     */
    public function process_checkout()
    {
        $userId = $this->session->userdata('user_id');

        if (!$userId) {
            redirect('auth/login');
        }

        $name = $this->input->post('recipient_name');
        $address = $this->input->post('recipient_address');
        $paymentMethod = $this->input->post('payment_method');

        if (!$name || !$address || !$paymentMethod) {
            $this->session->set_flashdata('error', 'Please fill in all fields.');
            redirect('cart');
        }

        $checkoutData = [
            'recipient_name' => $name,
            'recipient_address' => $address,
            'payment_method' => $paymentMethod,
        ];

        $orderId = $this->Order_model->createFromCart($userId, $checkoutData);

        if ($orderId) {
            $this->session->set_flashdata('success', 'Order placed successfully! Please complete payment.');
            redirect('cart/payment/' . $orderId);
        } else {
            $this->session->set_flashdata('error', 'Failed to place order. Cart might be empty.');
            redirect('cart');
        }
    }
    /**
     * Menampilkan halaman pembayaran untuk pesanan tertentu.
     * Memvalidasi kepemilikan pesanan dan menampilkan detail order serta instruksi pembayaran.
     */
    public function payment($id)
    {
        $order = $this->Order_model->getById($id);

        if (!$order || $order['user_id'] != $this->session->userdata('user_id')) {
            show_404();
        }

        $data['title'] = 'Payment';
        $data['order'] = $order;
        $data['items'] = $this->Order_item_model->getItemsByOrder($id);

        $this->render('cart/payment', $data);
    }

    /**
     * Mengunggah bukti pembayaran untuk pesanan.
     * Menangani upload file gambar, memvalidasi format, dan memperbarui status bukti bayar di database.
     */
    public function upload_proof($id)
    {
        $order = $this->Order_model->getById($id);

        if (!$order || $order['user_id'] != $this->session->userdata('user_id')) {
            show_404();
        }

        $config['upload_path'] = './public/assets/images/proofs/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        // Ensure directory exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        if (!$this->upload->do_upload('payment_proof')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect('cart/payment/' . $id);
        } else {
            $uploadData = $this->upload->data();
            $filename = 'proofs/' . $uploadData['file_name'];

            $this->Order_model->updatePaymentProof($id, $filename);
            
            // Set status to paid automatically, admin will review later
            $this->Order_model->update($id, ['status' => 'paid']);

            $this->session->set_flashdata('success', 'Payment proof uploaded successfully!');
            redirect('account');
        }
    }
}
