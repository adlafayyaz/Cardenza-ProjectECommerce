<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model', 'User_model']);

        // Hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List semua order.
     */
    public function index()
    {
        // Auto cancel old orders
        $this->Order_model->autoCancelOldOrders();

        $data['title'] = 'Manage Orders';
        $data['orders'] = $this->Order_model->getAllWithUser();

        $this->render('admin/orders', $data);
    }

    /**
     * Detail order.
     */
    public function show($id)
    {
        $order = $this->Order_model->getById($id);
        if (!$order) {
            show_404();
        }

        $data['title'] = 'Order Detail';
        $data['order'] = $order;
        $data['items'] = $this->Order_item_model->getItemsByOrder($id);

        $this->render('admin/order_detail', $data);
    }

    /**
     * Update status order.
     */
    public function update_status($id)
    {
        $status = $this->input->post('status');

        $this->Order_model->update($id, ['status' => $status]);
        $this->session->set_flashdata('success', 'Order status updated');

        redirect('admin/orders');
    }

    /**
     * Delete order.
     */
    public function delete($id)
    {
        // Optional: Check if order exists or can be deleted
        $this->Order_model->delete($id); 
        
        $this->session->set_flashdata('success', 'Order deleted successfully');
        redirect('admin/orders');
    }
}