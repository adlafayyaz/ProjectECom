<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Base model CRUD.
 */
class MY_Model extends CI_Model
{
    protected $table;
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
     * Ambil data by ID.
     */
    public function getById($id)
    {
        $query = $this->db->get_where($this->table, [$this->primaryKey => $id]);
        return $query->row_array();
    }

    /**
     * Insert data.
     */
    public function insert(array $data)
    {
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update data.
     */
    public function update($id, array $data)
    {
        $this->db->where($this->primaryKey, $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Hapus data.
     */
    public function delete($id)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $id]);
    }

    /**
     * Hitung total data.
     */
    public function countAll()
    {
        return $this->db->count_all($this->table);
    }
}
