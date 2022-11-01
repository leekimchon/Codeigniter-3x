<?php
class CustomerModel extends CI_Model
{
    private $database;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('mongodb');
        $this->database = $this->mongodb->getDB();
    }

    public function store($data_inserts)
    {
        // $this->db->insert('customers', $data_inserts);
        // return $this->db->insert_id();
        // dd(1);
        $this->database->customers->insertOne($data_inserts);
    }

    public function updateByEmail($email, $data_updates)
    {
        // $this->db->where('email', $email);
        // return $this->db->update('customers', $data_updates);
        $this->database->customers->updateOne(['email' => $email], ['$set' => $data_updates]);
    }

    public function findCustomerByCode($code)
    {
        // return $this->db->get_where('customers', array('code' => $code))->row();
        return $this->database->customers->findOne(['code' => $code]);
    }

    public function findCustomerByEmail($email)
    {
        return $this->database->customers->findOne(['email' => $email]);
    }

    public function mail_exists($email)
    {
        // $this->db->where('email', $email);
        // $query = $this->db->get('customers');
        // if ($query->num_rows() > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
        return $this->database->customers->findOne(['email' => $email]);
    }

    public function getAll()
    {
        // $customers = $this->db->get('customers');
        
        // return $customers->result();
        return $this->database->customers->find();
    }
}
