<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Order_model', 'Order_item_model', 'User_model']);
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Manage Orders';
        $data['orders'] = $this->Order_model->getAllWithUser();

        $this->render('admin/orders', $data);
    }

    public function show($id)
    {
        $order = $this->Order_model->getById($id);
        if (!$order) {
            show_404();
        }

        $data['title'] = 'Order Detail';
        $data['order'] = $order;
        $data['items'] = $this->Order_item_model->getItemsByOrder($id);

        // pakai template admin
        $this->render('admin/order_detail', $data);
    }

    public function update_status($id)
    {
        $status = $this->input->post('status');
        $this->Order_model->update($id, ['status' => $status]);
        $this->session->set_flashdata('success', 'Order status updated');
        redirect('admin/orders');
    }
}
