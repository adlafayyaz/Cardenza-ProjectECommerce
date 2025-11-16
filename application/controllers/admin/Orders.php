<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model', 'User_model']);
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List semua pesanan dengan status.
     */
    public function index()
    {
        $data['title'] = 'Manage Orders';
        $data['orders'] = $this->Order_model->getAllWithUser();
        $this->load->view('admin/orders', $data);
    }

    /**
     * Detail order (daftar item) & update status.
     *
     * @param int $id
     */
    public function show($id)
    {
        $order = $this->Order_model->getById($id);
        if (!$order) {
            show_404();
        }
        $data['title'] = 'Order Detail';
        $data['order'] = $order;
        $data['items'] = $this->Order_item_model->getByOrder($id);
        $this->load->view('admin/order_detail', $data);
    }

    /**
     * Update status order (pending, paid, shipped, completed).
     */
    public function update_status($id)
    {
        $status = $this->input->post('status');
        $this->Order_model->update($id, ['status' => $status]);
        $this->session->set_flashdata('success', 'Order status updated');
        redirect('admin/orders');
    }
}
