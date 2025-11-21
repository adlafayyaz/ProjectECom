<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Favourite_model extends MY_Model
{
    protected $table = 'favourites';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ambil semua favorit user.
     */
    public function getItems($userId)
    {
        $this->db->select('favourites.*, products.name, products.price, products.image, products.slug');
        $this->db->from($this->table);
        $this->db->join('products', 'products.id = favourites.product_id', 'left');
        $this->db->where('favourites.user_id', $userId);

        return $this->db->get()->result_array();
    }

    /**
     * Cek apakah produk favorit.
     */
    public function isFavourite($userId, $productId)
    {
        $row = $this->db->get_where($this->table, [
            'user_id' => $userId,
            'product_id' => $productId,
        ])->row_array();

        return !empty($row);
    }

    /**
     * Toggle favorit (add/remove).
     */
    public function toggle($userId, $productId)
    {
        if ($this->isFavourite($userId, $productId)) {
            $this->db->where('user_id', $userId);
            $this->db->where('product_id', $productId);
            $success = $this->db->delete($this->table);

            return ['status' => 'removed', 'success' => $success];
        }

        $success = $this->insert([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return ['status' => 'added', 'success' => $success ? true : false];
    }
}
