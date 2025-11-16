<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * Menampilkan daftar seluruh user (read‑only).
     */
    public function index()
    {
        $data['title'] = 'Manage Users';
        $data['users'] = $this->User_model->getAll();
        $this->load->view('admin/users', $data);
    }
}
