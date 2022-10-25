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
        $customers = $this->CustomerModel->getAll();
        $customers = json_encode($customers);
        $values = ['customers' => $customers];
        return $this->load->view('admin\customer\index', $values);
    }

    public function getAllcustomers()
    {
        $customers = $this->CustomerModel->getAll();
        echo json_encode($customers);
    }
}