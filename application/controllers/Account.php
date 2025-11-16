<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_model');
    }

    public function index()
    {
        // Harus login dulu
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }

        $userId = $this->session->userdata('user_id');

        $data['title'] = 'My Account';
        $data['orders'] = $this->Order_model->getOrdersByUser($userId);

        $this->render('account/index', $data);
    }
}
