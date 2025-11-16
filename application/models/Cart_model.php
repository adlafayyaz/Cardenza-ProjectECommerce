<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends MY_Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua item cart milik user, lengkap dengan data produk.
     *
     * @param int $userId
     *
     * @return array
     */
    public function getItems($userId)
    {
        $this->db->select('cart_items.*, products.name, products.price, products.image, products.slug');
        $this->db->from($this->table); // cart_items
        $this->db->join('products', 'products.id = cart_items.product_id', 'left');
        $this->db->where('cart_items.user_id', $userId);

        return $this->db->get()->result_array();
    }

    /**
     * Hitung total item (bisa jumlah baris atau jumlah quantity).
     * Di sini saya pakai jumlah baris cart (1 produk = 1 item).
     *
     * @param int $userId
     *
     * @return int
     */
    public function countItems($userId)
    {
        $this->db->from($this->table);
        $this->db->where('user_id', $userId);

        return (int) $this->db->count_all_results();
    }

    /**
     * Tambah atau update item di cart.
     * Jika sudah ada baris untuk (user, product), quantity akan ditambah.
     *
     * @param int $userId
     * @param int $productId
     * @param int $qty
     *
     * @return bool
     */
    public function addOrUpdate($userId, $productId, $qty = 1)
    {
        $existing = $this->db->get_where($this->table, [
            'user_id' => $userId,
            'product_id' => $productId,
        ])->row_array();

        if ($existing) {
            $newQty = $existing['quantity'] + $qty;
            $this->db->where('id', $existing['id']);

            return $this->db->update($this->table, ['quantity' => $newQty]);
        }

        return $this->insert([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $qty,
        ]);
    }

    /**
     * Update quantity spesifik.
     */
    public function updateQuantity($userId, $productId, $qty)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);

        return $this->db->update($this->table, ['quantity' => $qty]);
    }

    /**
     * Hapus satu item dari cart.
     */
    public function removeItem($userId, $productId)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);

        return $this->db->delete($this->table);
    }

    /**
     * Kosongkan cart user.
     */
    public function clearCart($userId)
    {
        $this->db->where('user_id', $userId);

        return $this->db->delete($this->table);
    }
}
