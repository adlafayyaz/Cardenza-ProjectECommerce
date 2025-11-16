<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Category_model']);
        $this->load->library(['form_validation', 'upload']);
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List produk dengan opsi search.
     */
    public function index()
    {
        $keyword = $this->input->get('q');
        $data['title'] = 'Manage Products';
        $data['products'] = $keyword ? $this->Product_model->search($keyword) : $this->Product_model->getAllWithCategory();
        $this->load->view('admin/products', $data);
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        $data['title'] = 'Add Product';
        $data['categories'] = $this->Category_model->getAll();
        $this->load->view('admin/product_form', $data);
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        if ($this->form_validation->run() === false) {
            $this->create();

            return;
        }
        // upload gambar jika ada
        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/assets/images/products/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $dataUpload = $this->upload->data();
                $imagePath = 'products/'.$dataUpload['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                $this->create();

                return;
            }
        }
        $slug = url_title($this->input->post('name'), 'dash', true);
        $insert = [
            'category_id' => $this->input->post('category_id'),
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'description' => $this->input->post('description'),
            'image' => $imagePath,
        ];
        $this->Product_model->insert($insert);
        $this->session->set_flashdata('success', 'Product created');
        redirect('admin/products');
    }

    /**
     * Form edit produk.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $product = $this->Product_model->getById($id);
        if (!$product) {
            show_404();
        }
        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['categories'] = $this->Category_model->getAll();
        $this->load->view('admin/product_form', $data);
    }

    /**
     * Memperbarui data produk.
     *
     * @param int $id
     */
    public function update($id)
    {
        $product = $this->Product_model->getById($id);
        if (!$product) {
            show_404();
        }
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        if ($this->form_validation->run() === false) {
            $this->edit($id);

            return;
        }
        // handle upload gambar baru jika ada
        $imagePath = $product->image;
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/assets/images/products/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('image')) {
                $dataUpload = $this->upload->data();
                $imagePath = 'products/'.$dataUpload['file_name'];
                // hapus file lama bila ada
                if ($product->image && file_exists('./public/assets/images/'.$product->image)) {
                    unlink('./public/assets/images/'.$product->image);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                $this->edit($id);

                return;
            }
        }
        $slug = url_title($this->input->post('name'), 'dash', true);
        $update = [
            'category_id' => $this->input->post('category_id'),
            'name' => $this->input->post('name'),
            'slug' => $slug,
            'price' => $this->input->post('price'),
            'stock' => $this->input->post('stock'),
            'description' => $this->input->post('description'),
            'image' => $imagePath,
        ];
        $this->Product_model->update($id, $update);
        $this->session->set_flashdata('success', 'Product updated');
        redirect('admin/products');
    }

    /**
     * Menghapus produk.
     *
     * @param int $id
     */
    public function delete($id)
    {
        $product = $this->Product_model->getById($id);
        if ($product) {
            // delete image file
            if ($product->image && file_exists('./public/assets/images/'.$product->image)) {
                unlink('./public/assets/images/'.$product->image);
            }
            $this->Product_model->delete($id);
            $this->session->set_flashdata('success', 'Product deleted');
        }
        redirect('admin/products');
    }
}
