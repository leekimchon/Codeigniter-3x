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
        $values = [];
        $data_inserts['name'] = $this->input->post('name');
        $data_inserts['email'] = $this->input->post('email');
        $data_inserts['mail_active'] = 0;
        $data_inserts['day_of_birth'] = $this->input->post('day_of_birth');
        $data_inserts['gender'] = $this->input->post('gender');
        $data_inserts['job'] = $this->input->post('job');
        $data_inserts['code'] = rand();
        $data_inserts['downloaded'] = 0;
        
        if ($this->CustomerModel->mail_exists($data_inserts['email'])) {
            $errors = ['email_exist' => true];
            $values = ['errors' => $errors, 'data_inserts' => $data_inserts];
        } else {
            $this->CustomerModel->store($data_inserts);

            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();

            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $sender = 'leekimchon005@gmail.com';
            $password = 'nizxgatcfndguiyq';
            $sender_name = 'Lê Chơn';

            $mail->Username = $sender;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($sender, $sender_name);

            $mail->addAddress($data_inserts['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Xác minh nhận tài liệu';
            $content = "<b>Chào " . $data_inserts['name'] . "!</b><br>Xác minh email của bạn" .
                "<form action='" . base_url('customer/confirm/') . "' method='POST'>
                    <input type='hidden' name='code' value='" . $data_inserts['code'] . "'>
                    <button>Xác nhận</button>
                </form>";
            $mail->Body = $content;
            $mail->send();
        }

        echo json_encode($values);
    }

    public function resendEmailConfirm()
    {
        $email = $this->input->post('email');
        $customer = $this->CustomerModel->findCustomerByEmail($email);
        $code = rand();
        $data_updates = ['code' => $code];
        $this->CustomerModel->updateByEmail($email, $data_updates);

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

        $mail->isSMTP();
        $mail->CharSet  = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $sender = 'leekimchon005@gmail.com';
        $password = 'nizxgatcfndguiyq';
        $sender_name = 'Lê Chơn';

        $mail->Username = $sender;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($sender, $sender_name);

        $mail->addAddress($customer->email);
        $mail->isHTML(true);
        $mail->Subject = 'Xác minh nhận tài liệu';
        $content = $content = "<b>Chào " . $customer->name . "!</b><br>Xác minh email của bạn" .
        "<form action='" . base_url('customer/confirm/') . "' method='POST'>
            <input type='hidden' name='code' value='" . $code . "'>
            <button>Xác nhận</button>
        </form>";
        $mail->Body = $content;
        $mail->send();
    }

    public function confirm()
    {
        $code = $this->input->post('code');
        $customer = $this->CustomerModel->findCustomerByCode($code);

        if ($customer) {
            $data_updates = ['mail_active' => 1];
            $this->CustomerModel->updateByEmail($customer->email, $data_updates);

            $this->load->library('phpmailer_lib');
            $mail = $this->phpmailer_lib->load();

            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $sender = 'leekimchon005@gmail.com';
            $password = 'nizxgatcfndguiyq';
            $sender_name = 'Lê Chơn';

            $mail->Username = $sender;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom($sender, $sender_name);

            $mail->addAddress($customer->email);
            $mail->isHTML(true);
            $mail->Subject = 'Nhận tài liệu';
            $content = "<b>Chào " . $customer->name . '!</b><br> Tải xuống tài liệu' .
                "<form action='" . base_url('customer/download') . "' method='POST'>
                    <input type='hidden' name='code' value='" . $code . "'>
                    <button>Tải xuống</button>
                </form>";
            $mail->Body = $content;
            $mail->send();
        }
        return $this->load->view('customer/confirmed');
    }

    public function download()
    {
        $code = $this->input->post('code');
        $customer = $this->CustomerModel->findCustomerByCode($code);

        if ($customer) {
            if (!$customer->downloaded_at) {
                $date = date('Y-m-d H:i:s');
                $data_updates = ['downloaded_at' => $date, 'downloaded' => 1];
                $this->CustomerModel->updateByEmail($customer->email, $data_updates);
            }
            force_download('download/test.txt', null);
        }
    }

    public function readMail($code = '')
    {
        $customer = $this->CustomerModel->findCustomerByCode($code);

        if ($customer) {
            if (!$customer->email_readed_at) {
                $date = date('Y-m-d H:i:s');
                $data_updates = ['email_readed_at' => $date];
                $this->CustomerModel->updateByEmail($customer->email, $data_updates);
            }
        }
    }
}
