<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');

        // Hanya admin yang bisa akses
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }
    }

    /**
     * List semua user.
     */
    public function index()
    {
        $data['title'] = 'Manage Users';
        $data['users'] = $this->User_model->getAll();

        $this->render('admin/users', $data);
    }
}
