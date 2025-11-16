<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Favorites extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Favourite_model');
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    /**
     * Menampilkan daftar produk favorit pengguna.
     */
    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $data['title'] = 'Favorites';
        $data['items'] = $this->Favourite_model->getItems($userId);
        $this->load->view('favourites/index', $data);
    }

    /**
     * Menambahkan atau menghapus favorit (toggle). Redirect kembali ke halaman sebelumnya.
     *
     * @param int $productId
     */
    public function toggle($productId)
    {
        $userId = $this->session->userdata('user_id');
        if ($productId && $userId) {
            $this->Favourite_model->toggle($userId, $productId);
        }
        $ref = $this->input->server('HTTP_REFERER') ?: base_url('products');
        redirect($ref);
    }
}
