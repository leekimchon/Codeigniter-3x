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
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['mail_active'] = 0;
        $data['day_of_birth'] = $this->input->post('day_of_birth');
        $data['gender'] = $this->input->post('gender');
        $data['job'] = $this->input->post('job');
        $data['code'] = rand();

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[customers.email]',
            array(
                'required' => 'vui lòng nhập %s',
                'valid_email' => '%s không đúng định dạng',
                'is_unique' => '%s đã đăng ký',
            )
        );
        $this->form_validation->set_rules(
            "name",
            "Tên",
            "required",
            array('required' => 'vui lòng nhập %s',)
        );
        $this->form_validation->set_rules(
            "day_of_birth",
            "Ngày sinh",
            "required",
            array('required' => 'vui lòng nhập %s',)
        );
        $this->form_validation->set_rules(
            "job",
            "Nghề nghiệp",
            "required",
            array('required' => 'vui lòng nhập %s',)
        );

        if ($this->form_validation->run() == false) {
            if ($this->CustomerModel->mail_exists($data['email'])) {
                $errors = ['email_exist' => true];
                $values = ['errors' => $errors, 'data' => $data];
            }
            return $this->load->view('customer/index', $values);
        }

        $id_insert = $this->CustomerModel->store($data);

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

        $mail->addAddress($data['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Xác minh nhận tài liệu';
        $content = "<b>Chào " . $data['name'] . "!</b><br>Xác minh email của bạn 
        <a href='" . base_url('customer/confirm/') . $data['code'] . "'>Tại đây.</a>";
        $mail->Body = $content;
        $mail->send();

        return $this->load->view('customer/confirm');
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
        $content = "<b>Chào " . $customer->name . "!</b><br>Xác minh email của bạn 
        <a href='" . base_url('customer/confirm/') . $code . "'>Tại đây.</a>";
        $mail->Body = $content;
        $mail->send();

        return $this->load->view('customer/confirm');
    }

    public function confirm($code = '')
    {
        $customer = $this->CustomerModel->findCustomerByCode($code);
        $values = ['customer' => $customer];

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
            $content = "<b>Chào " . $customer->name . '!</b><br> Tải xuống tài liệu 
            <a href="' . base_url('customer/download/') . $customer->code . '">Tại đây.</a>'
            .'<img src="https://7733-113-161-38-201.ap.ngrok.io/customer/read-mail/'. $customer->code .'" style="display: none;"/>';
            $mail->Body = $content;
            $mail->send();
        }
        return $this->load->view('customer/confirmed', $values);
    }

    public function download($code = '')
    {
        $customer = $this->CustomerModel->findCustomerByCode($code);

        if ($customer) {
            if (!$customer->dowloaded_at) {
                $date = date('Y-m-d H:i:s');
                $data_updates = ['dowloaded_at' => $date];
                $this->CustomerModel->updateByEmail($customer->email, $data_updates);
            }
            force_download('download/test.txt', null);
        }
    }

    public function readMail($code = ''){
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
