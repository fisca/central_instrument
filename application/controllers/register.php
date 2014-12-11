<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // ======== Library ======== //
        $this->load->library('session');
        $this->load->library('email');

        // ======== Driver ======== //
        $this->load->database();

        // ======== Helper ======== //
        $this->load->helper('url');
        $this->load->helper('html');

        // ======== Class ======== //
        $this->load->library('pagination');

        // ========= Commom Models ========= //
        $this->load->model('register_model');
    }

    public function index() {
        if (!$this->input->post('email')) {
            redirect('login');
        }
    }

    public function process() {
        $email = $this->input->post('email');
        if (!empty($email)):
            $this->send_confirm_email($email);
            $this->register_model->add_new_user();
            $email = urlencode($email);
            redirect("register/send_email/$email");
        else:
            redirect('login');
        endif;
    }

    public function send_confirm_email($email) {
        if (!empty($email)) {
            $confirm_code = substr(md5(microtime()), rand(0, 26), 16);

            // $config['protocol'] = 'smtp';
            // $config['smtp_host'] = 'smtp.gmail.com';
            // $config['smtp_user'] = '';
            // $config['smtp_pass'] = '';
            // $config['smtp_port'] = 465;
            $config['wordwrap'] = FALSE;

            $this->email->initialize($config);

            $this->email->from('xps_noreply@thep-center.org', 'XPS ThEP');
            $this->email->to($email);
            $this->email->subject('XPS Email confirmation');
            $message = "กรุณาคลิ้กยืนยันอีเมล >> http://cnxlove.com/central_instrument/index.php/register/confirm_email/$confirm_code";

            $this->email->message("$message");

            if ($this->email->send()) {
                $this->register_model->insert_confirm_code($confirm_code, $email);
            } else {
                redirect('login');
            }
        }
    }

    public function send_email($email) {
        if (!empty($email)):
            $data['title'] = "ขอบคุณที่สมัครใช้ใช้บริการ";
            $email = urldecode($email);
            $data['text'] = "<p>ระบบได้ส่งลิงค์ยืนยันการสมัครไปยังอีเมล: $email <br/> <strong>กรุณากดยืนยันลิงค์ดังกล่าวก่อน อีเมลของท่านจึงจะสามารถเข้าใช้งานได้</strong></p>";
            $this->load->view('templates/header', $data);
            $this->load->view('send_view');
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

    public function confirm_email($confirm_code) {
        if ($this->register_model->check_confirm_email($confirm_code) == FALSE):
            $data['title'] = 'ไม่สามารถยืนยันอีเมลได้ กรุณาตรวจสอบอีเมลที่ส่งไปยังที่อยู่อีเมลของท่าน';
            $this->load->view('templates/header', $data);
            $this->load->view('confirm_result', $data);
            $this->load->view('templates/footer');
        else:
            $email = $this->register_model->check_confirm_email($confirm_code);
            if ($this->register_model->login_after_confirm($email)) {
                redirect('home');
            } else {
                redirect('login');
            }
        endif;
    }

    public function check_email() {
        $data['msg'] = $this->register_model->get_email();
        $this->load->view('check_email_view', $data);
    }

}
