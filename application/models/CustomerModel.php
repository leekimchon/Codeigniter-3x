<?php 
class CustomerModel extends CI_Model
{
    public function __construct() {
        // $this->load->database('default');
        // $this->load->library('session');

        // Call the Model constructor
        parent::__construct();
    }

    public function store($data)
    {
        if ($this->db->insert('customers', $data)) {
            return true;
        } else {
            return false;
        }
    }
}