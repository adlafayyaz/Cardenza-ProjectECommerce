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

        // SEBELUM:
        // $this->load->view('cart/index', $data);

        // SESUDAH:
        $this->render('cart/index', $data);
    }

    // ADD
    public function add($productId)
    {
        $userId = $this->session->userdata('user_id');
        if ($productId && $userId) {
            $this->Cart_model->addOrUpdate($userId, $productId, 1);
            $this->session->set_flashdata('success', 'Item added to cart');
        }
        redirect('products/detail/'.$productId);
    }

    // UPDATE
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

    // REMOVE
    public function remove($productId)
    {
        $userId = $this->session->userdata('user_id');
        if ($userId && $productId) {
            $this->Cart_model->removeItem($userId, $productId);
            $this->session->set_flashdata('success', 'Item removed');
        }
        redirect('cart');
    }

    // CHECKOUT
    public function checkout()
    {
        $userId = $this->session->userdata('user_id');
        if (!$userId) {
            redirect('auth/login');
        }
        $orderId = $this->Order_model->createFromCart($userId);
        $this->Cart_model->clearCart($userId);
        $this->session->set_flashdata('success', 'Thank you! Your order has been placed.');
        redirect('account');
    }
}
