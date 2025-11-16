<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List semua kategori.
     */
    public function index()
    {
        $data['title'] = 'Manage Categories';
        $data['categories'] = $this->Category_model->getAll();
        $this->load->view('admin/categories', $data);
    }

    /**
     * Form tambah kategori.
     */
    public function create()
    {
        $data['title'] = 'Add Category';
        $this->load->view('admin/category_form', $data);
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === false) {
            $this->create();

            return;
        }
        $slug = url_title($this->input->post('name'), 'dash', true);
        $this->Category_model->insert([
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'description' => $this->input->post('description'),
        ]);
        $this->session->set_flashdata('success', 'Category created');
        redirect('admin/categories');
    }

    /**
     * Form edit kategori.
     */
    public function edit($id)
    {
        $category = $this->Category_model->getById($id);
        if (!$category) {
            show_404();
        }
        $data['title'] = 'Edit Category';
        $data['category'] = $category;
        $this->load->view('admin/category_form', $data);
    }

    /**
     * Mengupdate kategori.
     */
    public function update($id)
    {
        $category = $this->Category_model->getById($id);
        if (!$category) {
            show_404();
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() === false) {
            $this->edit($id);

            return;
        }
        $slug = url_title($this->input->post('name'), 'dash', true);
        $this->Category_model->update($id, [
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'description' => $this->input->post('description'),
        ]);
        $this->session->set_flashdata('success', 'Category updated');
        redirect('admin/categories');
    }

    /**
     * Menghapus kategori.
     */
    public function delete($id)
    {
        $this->Category_model->delete($id);
        $this->session->set_flashdata('success', 'Category deleted');
        redirect('admin/categories');
    }
}
