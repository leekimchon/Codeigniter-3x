<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustomerModel');
    }

    public function index(){
        return $this->load->view('admin/customer/index');
    }

    public function getAll()
    {
        $customers = $this->CustomerModel->getAll()->toArray();
        echo json_encode($customers);
    }
}