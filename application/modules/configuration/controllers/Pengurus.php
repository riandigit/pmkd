<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengurus extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        logged_in();

        $this->load->model('pengurus_model','model');
        $this->_table    = 'tbl_pengurus';
        $this->_username = $this->session->userdata('username');
        $this->_module   = 'configuration/pengurus';
    }
    public function index()
    {
        checkUrlAccess(uri_string(), 'view');
        if ($this->input->is_ajax_request()) {
            $rows = $this->group_model->groupList();
            echo json_encode($rows);
            exit;
        }

        $data = array(
            'home'        => 'Home',
            'url_home'    => site_url('home'),
            'parent'      => 'Konfigurasi Sistem',
            'url_parent'  => '#',
            'title'       => 'Pengurus',
            'content'     => 'pengurus/index',
            'btn_add'     => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add'))
        );

        $this->load->view('default', $data);
    }
    public function listPengurus(){
		validate_ajax();
		$list = $this->model->getDataPengurus();
		echo json_encode($list);
    }
    public function add(){
		validate_ajax();
        $data['title'] = 'Tambah Pengurus';
        $this->load->view($this->_module.'/add',$data);
	}
    public function action_add(){
        validate_ajax();
        $post = $this->input->post();
        $name = strtoupper($post['name']);
        
        /* validation */
        $this->form_validation->set_rules('name', 'Nama Grup', 'trim|required');
        $this->form_validation->set_message('required','%s harus diisi!');

        /* data post */
        $data = array(
            'name' => $name,
            'status' => 1
        );

        if($this->form_validation->run() == FALSE){
            $response = json_api(0,validation_errors());
        }else{
            $check = $this->global_model->checkData($this->_table,array('UPPER(name)' => $name));
            if($check){
                $response =  json_api(0,'Nama Grup '.$post['name'].' Sudah Ada'); 
            }else{
                $query = $this->global_model->saveData($this->_table, $data);
                if($query){
                    $response = json_api(1,'Simpan Data Berhasil');
                }else{
                    $response = json_encode($this->db->error()); 
                }
            }
        }

        $this->log_activitytxt->createLog($this->_username, uri_string(), 'ADD', json_encode($data), $response); 
        echo $response;
    }
}
