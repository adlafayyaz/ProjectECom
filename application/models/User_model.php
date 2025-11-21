<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model user.
 */
class User_model extends MY_Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil user berdasarkan email.
     */
    public function getByEmail($email)
    {
        $query = $this->db->get_where($this->table, ['email' => $email]);

        return $query->row_array();
    }

    /**
     * Buat user baru (password di-hash di controller).
     */
    public function createUser(array $data)
    {
        return $this->insert($data);
    }
}
