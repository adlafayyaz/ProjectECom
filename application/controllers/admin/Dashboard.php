<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['User_model', 'Product_model', 'Category_model', 'Order_model']);
    }

    /**
     * Tampilkan dashboard admin.
     */
    public function index()
    {
        $data['title'] = 'Admin Dashboard';
        $data['product_count'] = $this->Product_model->countAll();
        $data['category_count'] = $this->Category_model->countAll();
        $data['order_count'] = $this->Order_model->countAll();
        $data['user_count'] = $this->User_model->countAll();

        $this->render('admin/dashboard', $data);
    }
}
