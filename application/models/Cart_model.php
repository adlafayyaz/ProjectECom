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
     * Ambil semua item cart user.
     */
    public function getItems($userId)
    {
        $this->db->select('cart_items.*, products.name, products.price, products.image, products.slug');
        $this->db->from($this->table);
        $this->db->join('products', 'products.id = cart_items.product_id', 'left');
        $this->db->where('cart_items.user_id', $userId);

        return $this->db->get()->result_array();
    }

    /**
     * Hitung total item di cart.
     */
    public function countItems($userId)
    {
        $this->db->from($this->table);
        $this->db->where('user_id', $userId);

        return (int) $this->db->count_all_results();
    }

    /**
     * Tambah atau update item.
     */
    public function addOrUpdate($userId, $productId, $qty = 1)
    {
        $existing = $this->db->get_where($this->table, [
            'user_id'    => $userId,
            'product_id' => $productId,
        ])->row_array();

        if ($existing) {
            $newQty = $existing['quantity'] + $qty;
            $this->db->where('id', $existing['id']);

            return $this->db->update($this->table, ['quantity' => $newQty]);
        }

        return $this->insert([
            'user_id'    => $userId,
            'product_id' => $productId,
            'quantity'   => $qty,
        ]);
    }

    /**
     * Update quantity item.
     */
    public function updateQuantity($userId, $productId, $qty)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);

        return $this->db->update($this->table, ['quantity' => $qty]);
    }

    /**
     * Hapus satu item.
     */
    public function removeItem($userId, $productId)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('product_id', $productId);

        return $this->db->delete($this->table);
    }

    /**
     * Kosongkan cart.
     */
    public function clearCart($userId)
    {
        $this->db->where('user_id', $userId);

        return $this->db->delete($this->table);
    }
}
