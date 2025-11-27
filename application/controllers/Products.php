<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Favourite_model');
    }

    /**
     * Menampilkan daftar produk dengan fitur filter kategori.
     * Mengambil data kategori untuk dropdown dan data produk sesuai filter yang dipilih.
     */
    public function index()
    {
        $data['title'] = 'Products';

        // dropdown kategori
        $data['categories'] = $this->Category_model->getAll();

        $categorySlug = $this->input->get('category');
        $data['selected_category'] = $categorySlug ?: '';

        if ($categorySlug) {
            $category = $this->Category_model->getBySlug($categorySlug);

            if ($category) {
                $data['products'] = $this->Product_model->getByCategory($category['id']);
                $data['current_category_name'] = $category['name'];
            } else {
                $data['products'] = [];
                $data['current_category_name'] = 'Tidak ditemukan';
            }
        } else {
            $data['products'] = $this->Product_model->getAllWithCategory();
            $data['current_category_name'] = 'Semua';
        }

        $this->render('products/index', $data);
    }

    /**
     * Menampilkan halaman detail untuk satu produk tertentu.
     * Mengambil data produk berdasarkan slug dan menampilkannya ke view detail.
     */
    public function detail($slug = null)
    {
        if (!$slug) {
            show_404();
        }

        $product = $this->Product_model->getBySlug($slug);
        if (!$product) {
            show_404();
        }

        $data['product'] = $product;
        $data['title'] = $product['name'];

        $this->render('products/detail', $data);
    }

    /**
     * Menambahkan produk ke keranjang belanja pengguna.
     * Memeriksa sesi login dan memanggil model Cart untuk menyimpan item.
     */
    public function add_to_cart($productId)
    {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $userId = $this->session->userdata('user_id');
        $product = $this->Product_model->getById($productId);

        if (!$product) {
            show_404();
        }

        $this->Cart_model->addOrUpdate($userId, $productId, 1);
        $this->session->set_flashdata('success', 'Produk ditambahkan ke keranjang.');

        $ref = $this->input->server('HTTP_REFERER');
        redirect($ref ? $ref : 'cart');
    }

    /**
     * Menandai atau menghapus tanda favorit pada produk.
     * Mengubah status favorit produk untuk user yang sedang login.
     */
    public function toggle_favorite($productId)
    {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $userId = $this->session->userdata('user_id');
        $product = $this->Product_model->getById($productId);

        if (!$product) {
            show_404();
        }

        $this->Favourite_model->toggle($userId, $productId);
        $this->session->set_flashdata('success', 'Favorite diperbarui.');

        $ref = $this->input->server('HTTP_REFERER');
        redirect($ref ? $ref : 'favorites');
    }
}
