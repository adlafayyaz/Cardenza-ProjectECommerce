<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Base model untuk operasi CRUD umum.
 */
class MY_Model extends CI_Model
{
    /**
     * Nama tabel, didefinisikan di kelas turunan.
     *
     * @var string
     */
    protected $table;

    /**
     * Nama primary key, didefinisikan di kelas turunan.
     *
     * @var string
     */
    protected $primaryKey;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Ambil semua data.
     */
    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }

    /**
     * Ambil satu data berdasarkan primary key.
     */
    public function getById($id)
    {
        $query = $this->db->get_where($this->table, [$this->primaryKey => $id]);

        return $query->row_array();
    }

    /**
     * Tambah data baru.
     */
    public function insert(array $data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update data berdasarkan primary key.
     */
    public function update($id, array $data)
    {
        $this->db->where($this->primaryKey, $id);

        return $this->db->update($this->table, $data);
    }

    /**
     * Hapus data berdasarkan primary key.
     */
    public function delete($id)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }
}
