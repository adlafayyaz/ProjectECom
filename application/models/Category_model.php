<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model kategori.
 */
class Category_model extends MY_Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil kategori berdasarkan slug.
     */
    public function getBySlug($slug)
    {
        return $this->db->get_where($this->table, ['slug' => $slug])->row_array();
    }
}
