<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Cart_model');
        $this->load->model('Favourite_model');
    }

    /**
     * List semua produk + filter kategori.
     * URL: /products?category=slug.
     */
    public function index()
    {
        $data['title'] = 'Products';

        // ambil semua kategori untuk dropdown
        $data['categories'] = $this->Category_model->getAll();

        // slug kategori dari query string (?category=men)
        $categorySlug = $this->input->get('category');
        $data['selected_category'] = $categorySlug ?: '';

        if ($categorySlug) {
            $category = $this->Category_model->getBySlug($categorySlug);

            if ($category) {
                // produk sesuai kategori
                $data['products'] = $this->Product_model->getByCategory($category['id']);
                $data['current_category_name'] = $category['name'];
            } else {
                // slug kategori tidak ketemu → kosongkan produk
                $data['products'] = [];
                $data['current_category_name'] = 'Tidak ditemukan';
            }
        } else {
            // tanpa filter → semua produk
            $data['products'] = $this->Product_model->getAllWithCategory();
            $data['current_category_name'] = 'Semua';
        }

        $this->render('products/index', $data);
    }

    /**
     * Detail produk berdasarkan slug.
     * URL: /products/detail/{slug}.
     */
    public function detail($slug = null)
    {
        if (!$slug) {
            show_404();
        }

        $product = $this->Product_model->getBySlug($slug);

        if (!$product) {
            show_404();
        }

        $data['product'] = $product;                 // array
        $data['title'] = $product['name'];         // <-- pakai ['name'], bukan ->name

        $this->render('products/detail', $data);
    }

    /**
     * Tambah produk ke cart.
     * URL: /products/add_to_cart/{id}.
     */
    public function add_to_cart($productId)
    {
        // harus login dulu
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $userId = $this->session->userdata('user_id');
        $product = $this->Product_model->getById($productId);

        if (!$product) {
            show_404();
        }

        // tambah 1 qty, kalau sudah ada di cart akan di-update
        $this->Cart_model->addOrUpdate($userId, $productId, 1);

        $this->session->set_flashdata('success', 'Produk ditambahkan ke keranjang.');

        $ref = $this->input->server('HTTP_REFERER');
        redirect($ref ? $ref : 'cart');
    }

    /**
     * Toggle favorite (on/off).
     * URL: /products/toggle_favorite/{id}.
     */
    public function toggle_favorite($productId)
    {
        if (!$this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu.');
            redirect('auth/login');
        }

        $userId = $this->session->userdata('user_id');
        $product = $this->Product_model->getById($productId);

        if (!$product) {
            show_404();
        }

        $this->Favourite_model->toggle($userId, $productId);

        $this->session->set_flashdata('success', 'Favorite diperbarui.');

        $ref = $this->input->server('HTTP_REFERER');
        redirect($ref ? $ref : 'favorites');
    }
}
