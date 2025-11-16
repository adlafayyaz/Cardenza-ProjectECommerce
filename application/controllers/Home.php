<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index()
    {
        $data['title'] = 'Home';

        // kalau kamu punya method get_featured di Product_model
        if (method_exists($this->Product_model, 'get_featured')) {
            $data['featured_products'] = $this->Product_model->get_featured(4);
        } else {
            // fallback: ambil produk terbaru saja
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(4);
            $data['featured_products'] = $this->db->get('products')->result_array();
        }

        // PENTING: pakai render, jangan load->view manual
        $this->render('home/index', $data);
    }
}
