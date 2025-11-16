<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model pesanan untuk tabel `orders`.
 *
 * Menyediakan metode untuk:
 * - membuat pesanan baru beserta item-itemnya,
 * - mengambil pesanan berdasarkan pengguna,
 * - menampilkan pesanan dengan informasi user,
 * - dan mengambil detail pesanan lengkap dengan item-itemnya.
 */
class Order_model extends MY_Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_item_model'); // untuk menyimpan order_items
    }

    /**
     * Buat pesanan baru beserta item-itemnya.
     *
     * @param array $orderData Data order: ['user_id', 'total_price', 'status', ...]
     * @param array $itemsData Array item: [['product_id', 'quantity', 'price'], ...]
     *
     * @return int|false ID order jika sukses, false jika gagal
     */
    public function createOrder(array $orderData, array $itemsData)
    {
        $this->db->trans_start();

        // Insert ke tabel orders
        $this->db->insert($this->table, $orderData);
        $orderId = $this->db->insert_id();

        // Insert item-itemnya
        foreach ($itemsData as $item) {
            $item['order_id'] = $orderId;
            $this->Order_item_model->insert($item);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            return false;
        }

        return $orderId;
    }

    /**
     * Ambil semua pesanan milik satu user (simple, tanpa join).
     *
     * @param int $userId
     *
     * @return array
     */
    public function getByUser($userId)
    {
        $query = $this->db->get_where($this->table, ['user_id' => $userId]);

        return $query->result_array();
    }

    /**
     * Versi lain yang namanya cocok dengan Account controller:
     * Ambil pesanan milik user, bisa ditambah join ke tabel users kalau perlu.
     *
     * @param int $userId
     *
     * @return array
     */
    public function getOrdersByUser($userId)
    {
        $this->db->select('orders.*, users.name AS customer_name, users.email AS customer_email');
        $this->db->from($this->table); // orders
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->where('orders.user_id', $userId);
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil semua pesanan (untuk admin) dengan informasi user.
     *
     * @return array
     */
    public function getAllWithUser()
    {
        $this->db->select('orders.*, users.name AS customer_name, users.email AS customer_email');
        $this->db->from($this->table); // orders
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil detail satu pesanan beserta item-itemnya.
     *
     * @param int $orderId
     *
     * @return array|null ['order' => ..., 'items' => [...]] atau null jika tidak ada
     */
    public function getOrderWithItems($orderId)
    {
        // Ambil order
        $order = $this->getById($orderId);
        if (!$order) {
            return null;
        }

        // Ambil item-item
        $items = $this->Order_item_model->getItemsByOrder($orderId);

        return [
            'order' => $order,
            'items' => $items,
        ];
    }

    /**
     * Perbarui status pesanan.
     *
     * @param int    $id     ID order
     * @param string $status status baru (pending/paid/shipped/completed)
     *
     * @return bool
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }
}
