<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Product_model', 'Category_model']);
        $this->load->library(['form_validation', 'upload']);

        // Hanya admin yang boleh akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List produk + search.
     */
    public function index()
    {
        $keyword = $this->input->get('q');
        $data['title'] = 'Manage Products';
        $data['products'] = $keyword
            ? $this->Product_model->search($keyword)
            : $this->Product_model->getAllWithCategory();

        $this->render('admin/products', $data);
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        $data['title'] = 'Add Product';
        $data['categories'] = $this->Category_model->getAll();

        $this->render('admin/product_form', $data);
    }

    /**
     * Simpan produk baru.
     */
    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if ($this->form_validation->run() === false) {
            return $this->create();
        }

        $imagePath = null;

        // Upload gambar
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/assets/images/products/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $dataUpload = $this->upload->data();
                $imagePath = 'products/'.$dataUpload['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());

                return $this->create();
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

        $this->render('admin/product_form', $data);
    }

    /**
     * Update produk.
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
            return $this->edit($id);
        }

        // Pakai gambar lama jika tidak upload baru
        $imagePath = is_array($product) ? $product['image'] : $product->image;

        // Upload gambar baru jika ada
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './public/assets/images/products/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image')) {
                $dataUpload = $this->upload->data();
                $imagePath = 'products/'.$dataUpload['file_name'];

                // Hapus gambar lama
                $oldImage = is_array($product) ? $product['image'] : $product->image;
                if ($oldImage && file_exists('./public/assets/images/'.$oldImage)) {
                    unlink('./public/assets/images/'.$oldImage);
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());

                return $this->edit($id);
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
     * Hapus produk.
     */
    public function delete($id)
    {
        $product = $this->Product_model->getById($id);

        if ($product) {
            $img = is_array($product) ? $product['image'] : $product->image;

            if ($img && file_exists('./public/assets/images/'.$img)) {
                unlink('./public/assets/images/'.$img);
            }

            $this->Product_model->delete($id);
            $this->session->set_flashdata('success', 'Product deleted');
        }

        redirect('admin/products');
    }
}
