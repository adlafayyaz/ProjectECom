<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model produk.
 */
class Product_model extends MY_Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua produk beserta kategori.
     */
    public function getAllWithCategory()
    {
        $this->db->select('products.*, categories.name AS category_name, categories.slug AS category_slug');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->order_by('products.created_at', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil beberapa produk sebagai best seller.
     */
    public function getBestSellers($limit = 4)
    {
        $this->db->select('products.*, categories.name AS category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->order_by('products.id', 'DESC');
        $this->db->limit($limit);

        return $this->db->get()->result_array();
    }

    /**
     * Ambil satu produk berdasarkan ID.
     */
    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    /**
     * Ambil satu produk berdasarkan slug.
     */
    public function getBySlug($slug)
    {
        return $this->db->get_where($this->table, ['slug' => $slug])->row_array();
    }

    /**
     * Ambil produk berdasarkan kategori tertentu.
     */
    public function getByCategory($categoryId)
    {
        $this->db->select('products.*, categories.name AS category_name, categories.slug AS category_slug');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = products.category_id', 'left');
        $this->db->where('products.category_id', $categoryId);

        return $this->db->get()->result_array();
    }

    /**
     * Cari produk berdasarkan nama atau deskripsi.
     */
    public function search($keyword)
    {
        $this->db->like('name', $keyword);
        $this->db->or_like('description', $keyword);

        return $this->db->get($this->table)->result_array();
    }

    /**
     * Ambil produk unggulan (featured) untuk homepage.
     */
    public function get_featured($limit = 4)
    {
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit);

        return $this->db->get($this->table)->result_array();
    }

    /**
     * Kurangi stok produk (tidak boleh negatif).
     */
    public function decreaseStock($id, $quantity)
    {
        $product = $this->getById($id);
        if (!$product) {
            return false;
        }

        $newStock = max(0, (int) $product['stock'] - (int) $quantity);

        return $this->update($id, ['stock' => $newStock]);
    }
}
