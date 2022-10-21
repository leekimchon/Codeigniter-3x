<?php
class CustomerModel extends CI_Model
{
    public function __construct()
    {
        // $this->load->database('default');
        // $this->load->library('session');

        // Call the Model constructor
        parent::__construct();
    }

    public function store($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }

    public function updateByEmail($email, $data_updates)
    {
        $this->db->where('email', $email);
        return $this->db->update('customers', $data_updates);
    }

    public function findCustomerByCode($code)
    {
        return $this->db->get_where('customers', array('code' => $code))->row();
    }

    public function findCustomerByEmail($email)
    {
        return $this->db->get_where('customers', array('email' => $email))->row();
    }

    public function mail_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('customers');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function updateDownloadedByEmail($email,)
    {
        $this->db->where('email', $email);
    }

    public function getAll()
    {
        $customers = $this->db->get('customers');
        
        return $customers->result();
    }
}
