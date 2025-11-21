<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    /**
     * Tampilkan halaman home.
     */
    public function index()
    {
        $data['title'] = 'Home';

        // Ambil produk unggulan jika tersedia
        if (method_exists($this->Product_model, 'get_featured')) {
            $data['featured_products'] = $this->Product_model->get_featured(4);
        } else {
            // Fallback: ambil produk terbaru
            $this->db->order_by('created_at', 'DESC');
            $this->db->limit(4);
            $data['featured_products'] = $this->db->get('products')->result_array();
        }

        // Ambil best seller
        $data['best_sellers'] = $this->Product_model->getBestSellers(4);

        $this->render('home/index', $data);
    }
}
