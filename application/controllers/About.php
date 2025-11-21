<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tampilkan halaman About.
     */
    public function index()
    {
        $data['title'] = 'About';
        $this->render('about/index', $data);
    }
}
