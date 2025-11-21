<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model pesanan.
 */
class Order_model extends MY_Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_item_model');
        $this->load->model('Cart_model');
    }

    /**
     * Membuat satu pesanan beserta item-itemnya.
     */
    public function createOrder(array $orderData, array $itemsData)
    {
        $this->db->trans_start();

        $this->db->insert($this->table, $orderData);
        $orderId = $this->db->insert_id();

        foreach ($itemsData as $item) {
            $item['order_id'] = $orderId;
            $this->Order_item_model->insert($item);
        }

        $this->db->trans_complete();

        return $this->db->trans_status() ? $orderId : false;
    }

    /**
     * Membuat pesanan baru berdasarkan isi cart user.
     */
    public function createFromCart($userId)
    {
        $cartItems = $this->Cart_model->getItems($userId);
        if (empty($cartItems)) {
            return false;
        }

        $total = 0;
        $itemsData = [];

        foreach ($cartItems as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;

            $itemsData[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
        }

        $orderData = [
            'user_id' => $userId,
            'total_price' => $total,
            'status' => 'pending',
            'order_date' => date('Y-m-d H:i:s'),
        ];

        $orderId = $this->createOrder($orderData, $itemsData);

        if ($orderId) {
            $this->Cart_model->clearCart($userId);
        }

        return $orderId;
    }

    /**
     * Ambil daftar pesanan milik satu user.
     */
    public function getOrdersByUser($userId)
    {
        $this->db->select('orders.*, users.name AS customer_name, users.email AS customer_email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->where('orders.user_id', $userId);
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }

    /**
     * Ambil semua pesanan untuk admin beserta data user.
     */
    public function getAllWithUser()
    {
        $this->db->select('orders.*, users.name AS user_name, users.email AS user_email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = orders.user_id', 'left');
        $this->db->order_by('orders.order_date', 'DESC');

        return $this->db->get()->result_array();
    }
}
