<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{

    public function __construct(){
        parent::__construct();
        // $this->load->model('login_model', 'login');
        // $this->load->library(array('bcrypt', 'curl', 'form_validation', 'session'));
        // $this->load->helper('captcha');
    }
    public function index(){
		$this->load->view('index');
	}
}