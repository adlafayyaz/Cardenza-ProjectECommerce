<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model kategori untuk tabel `categories`.
 *
 * Menyediakan fungsi untuk mendapatkan kategori berdasarkan slug
 * atau mengambil semua kategori. Fungsi CRUD dasar diwarisi dari MY_Model.
 */
class Category_model extends MY_Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /** Ambil satu kategori berdasarkan slug. */
    public function getBySlug($slug)
    {
        $query = $this->db->get_where($this->table, ['slug' => $slug]);

        return $query->row_array();
    }
}
