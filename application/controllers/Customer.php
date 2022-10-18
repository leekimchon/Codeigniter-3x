<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CustomerModel');
    }

    public function index()
    {
        return $this->load->view('customer/index');
    }

    public function store()
    {
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['age'] = $this->input->post('age');
        $data['gender'] = $this->input->post('gender');
        $data['job'] = $this->input->post('job');

        $insert = $this->CustomerModel->store($data);

        if($insert){
            redirect(base_url('/customer'));
        }
    }
}
