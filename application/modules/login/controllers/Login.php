<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model', 'login');
        $this->load->library(array('bcrypt', 'curl', 'form_validation', 'session'));
        $this->load->helper('captcha');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('home');
        }

        $this->load->view('login');
    }

    // public function capcay(){
    //     $this->load->view('ratcha_image');
    // }

    public function do_login()
    {
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        $ratcha   = strtolower(trim($this->input->post('ratcha')));

        $user = $this->login->check_user($username)->row();

        $data = array(
            "username" => $username
        );

        // pengecekan user
        if ($user) {

            $check_pass = $this->bcrypt->check_password(strtoupper(md5($password)), $user->password);
            if (!$check_pass) {
                $message['error'] = 'Username Atau Password Tidak Cocok. ';
                echo json_encode($message);
                $res = array(
                    "code" => "0",
                    "message" => $message['error']
                );

                $created_by   = $username; // karna belum ada session maka di ambil dari inputanuya
                $log_url      = site_url() . 'login';
                $log_method   = 'login';
                $log_param    = json_encode($data);
                $log_response = json_encode($res);

                $this->log_activitytxt->createLog($created_by, $log_url, $log_method, $log_param, $log_response);
                exit;
            }

            $session = array(
                'logged_in'    => 1,
                'id'           => $user->id,
                'group_id'     => $user->group_id,
                'firstname'    => $user->nama,
                'username'     => $user->username,
                'runggun_id' => $this->enc->encode($user->runggun_id),
            );

            $this->session->set_userdata($session);

            $message['success'] = 'Login success. ';
            $message['status'] =$user->status_user;
            echo json_encode($message);
            $res = array(
                "code" => "1",
                "message" => $message['success'],
                "status" => $user->status_user,
            );
        } else {
            $message['error'] = 'Username tidak terdaftar. ';
            echo json_encode($message);
            $res = array(
                "code" => "0",
                "message" =>
                $message['error']
            );
            exit;
        }

        $created_by   = $username; // karna belum ada session maka di ambil dari inputanuya
        $log_url      = site_url() . 'login';
        $log_method   = 'login';
        $log_param    = json_encode($data);
        $log_response = json_encode($res);

        $this->log_activitytxt->createLog($created_by, $log_url, $log_method, $log_param, $log_response);
    }

    public function do_logout()
    {
        $created_by   = $this->session->userdata('username');
        $log_url      = site_url() . 'logout';
        $log_method   = 'logout';
        $log_param    = '';

        $log_response = json_encode(
            array(
                "code" => "1",
                "message" => "Berhasil logout"
            )
        );

        $this->log_activitytxt->createLog($created_by, $log_url, $log_method, $log_param, $log_response);
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();

        redirect('main');
    }
}
