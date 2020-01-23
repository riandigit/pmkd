<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Runggun extends MY_Controller {

	public function __construct() {
		parent::__construct();
        logged_in();

		$this->load->model('M_runggun','model');
        $this->_table    = 'tbl_user_group';
        $this->_username = $this->session->userdata('username');
        $this->_runggun = $this->session->userdata('operator_id');
        $this->_module   = 'pengurus/runggun';
    }
    public function index() {
        checkUrlAccess(uri_string(),'view');
        if($this->input->is_ajax_request()){
            $rows = $this->group_model->groupList();
            echo json_encode($rows);
            exit;
        }

		$data = array(
	        'home'        => 'Home',
	        'url_home'    => site_url('home'),
	        'parent'      => 'Konfigurasi Sistem',
	        'url_parent'  => '#',
	        'title'       => 'Grup',
	        'content'     => 'group/index',
            'btn_add'     => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add'))
        );

		$this->load->view ( 'default', $data );
	}

}