<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(['url', 'form', 'security']);

        // Data global
        $this->data['app_name'] = 'E-Shop';
        $this->data['base_url'] = base_url();
        $this->data['current_user'] = null;
        $this->data['cart_count'] = 0;

        $userId = $this->session->userdata('user_id');

        // Current user
        if ($userId) {
            $this->load->model('User_model');
            $this->data['current_user'] = $this->User_model->getById($userId);
        }

        // Cart count
        if ($userId) {
            $this->load->model('Cart_model');
            $this->data['cart_count'] = $this->Cart_model->countItems($userId);
        }
    }

    protected function render($view, $data = [], $return = false)
    {
        $data = array_merge($this->data, $data);

        $output = $this->load->view('layouts/header', $data, true);
        $output .= $this->load->view($view, $data, true);
        $output .= $this->load->view('layouts/footer', $data, true);

        if ($return) {
            return $output;
        }

        echo $output;
    }
}
