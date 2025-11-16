<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model item pesanan untuk tabel `order_items`.
 *
 * Menyediakan fungsi untuk mengambil item berdasarkan ID pesanan.
 */
class Order_item_model extends MY_Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /** Ambil semua item dari satu pesanan. */
    public function getItemsByOrder($orderId)
    {
        $query = $this->db->get_where($this->table, ['order_id' => $orderId]);

        return $query->result_array();
    }
}
