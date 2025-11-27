<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model pesanan.
 */
class Order_model extends MY_Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_item_model');
        $this->load->model('Cart_model');
    }

    /**
     * Membuat satu pesanan baru beserta item-itemnya dalam satu transaksi database.
     * Menggunakan transaction untuk memastikan integritas data antara tabel orders dan order_items.
     */
    public function createOrder(array $orderData, array $itemsData)
    {
        $this->db->trans_start();

        $this->db->insert($this->table, $orderData);
        $orderId = $this->db->insert_id();

        foreach ($itemsData as $item) {
            $item['order_id'] = $orderId;
            $this->Order_item_model->insert($item);
        }

        $this->db->trans_complete();

        return $this->db->trans_status() ? $orderId : false;
    }

    /**
     * Membuat pesanan baru berdasarkan isi keranjang belanja pengguna saat ini.
     * Menghitung total harga, menyiapkan data item, dan membersihkan keranjang setelah pesanan berhasil dibuat.
     */
    public function createFromCart($userId, $checkoutData)
    {
        $cartItems = $this->Cart_model->getItems($userId);
        if (empty($cartItems)) {
            return false;
        }

        $total = 0;
        $itemsData = [];

        foreach ($cartItems as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $itemsData[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
        }

        $orderData = [
            'user_id' => $userId,
            'recipient_name' => $checkoutData['recipient_name'],
            'recipient_address' => $checkoutData['recipient_address'],
            'payment_method' => $checkoutData['payment_method'],
            'total_price' => $total,
            'status' => 'pending',
            'order_date' => date('Y-m-d H:i:s'),
        ];

        $orderId = $this->createOrder($orderData, $itemsData);

        if ($orderId) {
            $this->Cart_model->clearCart($userId);
        }

        return $orderId;
    }

    /**
     * Mengambil daftar riwayat pesanan milik pengguna tertentu.
     * Melakukan join dengan tabel users untuk mendapatkan informasi pelanggan terkait.
     */
    public function getOrdersByUser($userId)
    {
        $this->db->select('orders.*, users.name AS customer_name, users.email AS customer_email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->where('orders.user_id', $userId);
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Mengambil seluruh data pesanan untuk keperluan admin.
     * Menampilkan semua order dari semua user, diurutkan dari yang terbaru.
     */
    public function getAllWithUser()
    {
        $this->db->select('orders.*, users.name AS user_name, users.email AS user_email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Mengambil detail lengkap satu pesanan berdasarkan ID.
     * Mengembalikan satu baris data pesanan beserta informasi user pemesan.
     */
    public function getById($id)
    {
        $this->db->select('orders.*, users.name AS user_name, users.email AS user_email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->where('orders.id', $id);
        return $this->db->get()->row_array();
    }

    /**
     * Memperbarui nama file bukti pembayaran untuk pesanan tertentu.
     */
    public function updatePaymentProof($id, $filename)
    {
        return $this->update($id, ['payment_proof' => $filename]);
    }

    /**
     * Menghapus data pesanan dari database berdasarkan ID.
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('orders');
    }

    /**
     * Membatalkan otomatis pesanan yang statusnya masih pending lebih dari 1 hari.
     * Dijalankan secara berkala atau saat admin membuka halaman order untuk membersihkan pesanan kadaluarsa.
     */
    public function autoCancelOldOrders()
    {
        // 1 day ago
        $threshold = date('Y-m-d H:i:s', strtotime('-1 day'));

        $this->db->where('status', 'pending');
        $this->db->where('order_date <', $threshold);
        $this->db->update($this->table, ['status' => 'cancelled']);
        
        return $this->db->affected_rows();
    }
}
