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

        $this->data['app_name'] = 'E‑Shop';
        $this->data['base_url'] = base_url();

        $this->data['current_user'] = null;
        if ($this->session->userdata('user_id')) {
            $this->load->model('User_model');
            $this->data['current_user'] = $this->User_model->getById($this->session->userdata('user_id'));
        }

        $this->data['cart_count'] = 0;
        if ($this->session->userdata('user_id')) {
            $this->load->model('Cart_model');
            $this->data['cart_count'] = $this->Cart_model->countItems($this->session->userdata('user_id'));
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
