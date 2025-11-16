<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function login()
    {
        // Kalau sudah login, langsung ke account
        if ($this->session->userdata('user_id')) {
            redirect('account');
        }

        $data['title'] = 'Login';

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email', true);
                $password = $this->input->post('password');

                $user = $this->User_model->getByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    // simpan data user di session
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'role' => $user['role'],
                        'name' => $user['name'],
                    ]);

                    // kalau admin, arahkan ke admin dashboard
                    if ($user['role'] === 'admin') {
                        redirect('admin/dashboard');
                    }

                    redirect('account');
                } else {
                    $this->session->set_flashdata('error', 'Email atau password salah.');
                }
            }
        }

        $this->render('auth/login', $data);
    }

    public function register()
    {
        if ($this->session->userdata('user_id')) {
            redirect('account');
        }

        $data['title'] = 'Register';

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run()) {
                $insert = [
                    'name' => $this->input->post('name', true),
                    'email' => $this->input->post('email', true),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role' => 'customer',
                ];

                if ($this->User_model->createUser($insert)) {
                    $this->session->set_flashdata('success', 'Registrasi berhasil, silakan login.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
                }
            }
        }

        $this->render('auth/register', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
