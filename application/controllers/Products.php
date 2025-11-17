<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
    }

    public function index()
    {
        $data['title'] = 'Products';
        $data['categories'] = $this->Category_model->getAll();
        $data['products'] = $this->Product_model->getAllWithCategory();

        $this->render('products/index', $data); // ini otomatis pakai header & footer
    }

    /**
     * Menampilkan detail produk berdasarkan slug.
     *
     * @param string $slug
     */
    public function detail($slug)
    {
        $product = $this->Product_model->getBySlug($slug);
        if (!$product) {
            show_404();
        }

        $data['title'] = $product->name;
        $data['product'] = $product;

        // DULU:
        // $this->load->view('products/detail', $data);

        // SEKARANG:
        $this->render('products/detail', $data);
    }
}
