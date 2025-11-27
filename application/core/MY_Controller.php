<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Base controller untuk user (frontend).
 */
class MY_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(['url', 'form', 'security']);

        // Data global
        $this->data['app_name'] = 'Cardenza';
        $this->data['base_url'] = base_url();
        $this->data['current_user'] = null;
        $this->data['current_user'] = null;
        $this->data['cart_count'] = 0;
        $this->data['hide_footer'] = false; // Default show footer

        $userId = $this->session->userdata('user_id');

        // Ambil data user login
        if ($userId) {
            $this->load->model('User_model');
            $this->data['current_user'] = $this->User_model->getById($userId);
        }

        // Hitung item cart
        if ($userId) {
            $this->load->model('Cart_model');
            $this->data['cart_count'] = $this->Cart_model->countItems($userId);
        }
    }

    /**
     * Render halaman user.
     */
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

/**
 * Base controller untuk admin (backend).
 */
class Admin_Controller extends CI_Controller
{
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(['url', 'form', 'security']);

        // Wajib admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        // Data global admin
        $this->data['app_name'] = 'Cardenza Admin';
        $this->data['base_url'] = base_url();
        $this->data['admin_name'] = $this->session->userdata('name');
    }

    /**
     * Render halaman admin.
     */
    protected function render($view, $data = [], $return = false)
    {
        $data = array_merge($this->data, $data);

        $output = $this->load->view('layouts/admin_header', $data, true);
        $output .= $this->load->view($view, $data, true);
        $output .= $this->load->view('layouts/admin_footer', $data, true);

        if ($return) {
            return $output;
        }

        echo $output;
    }
}
