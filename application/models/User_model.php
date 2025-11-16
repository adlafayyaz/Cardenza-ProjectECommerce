<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model pengguna untuk tabel `users`.
 *
 * Menyediakan fungsi tambahan untuk mencari pengguna berdasarkan email
 * dan memeriksa keberadaan email. Model ini mewarisi fungsi CRUD dari
 * MY_Model.
 */
class User_model extends MY_Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /** Ambil satu pengguna berdasarkan email. */
    public function getByEmail($email)
    {
        $query = $this->db->get_where($this->table, ['email' => $email]);

        return $query->row_array();
    }

    /** Periksa apakah email sudah terdaftar. */
    public function isEmailExists($email)
    {
        $query = $this->db->get_where($this->table, ['email' => $email]);

        return $query->num_rows() > 0;
    }

    /** Daftarkan pengguna baru. Password harus sudah di-hash. */
    public function createUser(array $data)
    {
        return $this->insert($data);
    }

    /** Ambil semua pengguna berperan customer. */
    public function getCustomers()
    {
        $this->db->where('role', 'customer');

        return $this->db->get($this->table)->result_array();
    }
}
