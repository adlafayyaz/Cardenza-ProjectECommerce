<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Cart_model', 'Product_model', 'Order_model']);
        // Hanya pengguna terautentikasi yang boleh mengakses cart
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    /**
     * Menampilkan isi keranjang pengguna.
     */
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Cart';
        $data['items'] = $this->Cart_model->getItems($userId);
        $this->load->view('cart/index', $data);
    }

    /**
     * Menambah produk ke cart. Jika produk sudah ada, quantity ditambah.
     *
     * @param int $productId
     */
    public function add($productId)
    {
        $userId = $this->session->userdata('user_id');
        if ($productId && $userId) {
            $this->Cart_model->addItem($userId, $productId);
            $this->session->set_flashdata('success', 'Item added to cart');
        }
        redirect('products/detail/'.$productId);
    }

    /**
     * Memperbarui quantity produk dalam cart melalui form POST `quantity[id] => qty`.
     */
    public function update()
    {
        $quantities = $this->input->post('quantity');
        if ($quantities) {
            foreach ($quantities as $id => $qty) {
                $this->Cart_model->updateQuantity($id, (int) $qty);
            }
            $this->session->set_flashdata('success', 'Cart updated');
        }
        redirect('cart');
    }

    /**
     * Menghapus item cart berdasarkan id baris cart_items.
     *
     * @param int $id
     */
    public function remove($id)
    {
        $this->Cart_model->removeItem($id);
        $this->session->set_flashdata('success', 'Item removed');
        redirect('cart');
    }

    /**
     * Checkout: buat order baru dari cart lalu kosongkan cart.
     */
    public function checkout()
    {
        $userId = $this->session->userdata('user_id');
        if (!$userId) {
            redirect('auth/login');
        }
        $orderId = $this->Order_model->createFromCart($userId);
        $this->Cart_model->clear($userId);
        $this->session->set_flashdata('success', 'Thank you! Your order has been placed.');
        redirect('account');
    }
}
