<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Device_type extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_device_type');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/device_type';
		$this->_table = 'app.t_mtr_device_type';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_device_type->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Tipe Perangkat',
			'content'  => 'master/device_type/index',
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Tambah Tipe Perangkat';
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$name = $this->input->post('name');

		$data = array(
			'name' => $name,
			'status' => 1,
			'created_by' => $this->session->userdata('username'),
			'created_on' => date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('name', 'name', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'Ada data kosong');
		} else {

			$this->db->trans_begin();
			$this->global_model->insert($this->_table,$data);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo $res=json_api(0, 'Gagal tambah data');
			}
			else
			{
				$this->db->trans_commit();
				echo $res=json_api(1, 'Berhasil tambah data');
			}
		}

		 /* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/device_type/action_add';
		$logMethod   = 'ADD';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

	public function edit($id)
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($id);
		$data['title'] = 'Edit Tipe Perangkat';
		$data['detail'] = $this->m_device_type->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$name = $this->input->post('name');

		$this->form_validation->set_rules('name', 'name', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

		$data = array(
			'name' => $name,
			'updated_by'=>$this->session->userdata('username'),
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} else {
			$this->db->trans_begin();
			$this->global_model->update($this->_table, $data , "id = $id");

			if ($this->db->trans_status() === FALSE) {   
				$this->db->trans_rollback();
				echo $res = json_api(0, 'Gagal edit data');
			} else {
				$this->db->trans_commit();
				echo $res = json_api(1, 'Berhasil edit data');
			}
		}

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/device_type/action_edit';
		$logMethod   = 'EDIT';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

	public function action_delete($id)
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'delete');

		$data=array(
			'status' => -5,
			'updated_on' => date("Y-m-d H:i:s"),
			'updated_by' => $this->session->userdata('username'),
		);

		$id = $this->enc->decode($id);

		$this->db->trans_begin();
		$this->global_model->update($this->_table, $data, " id='".$id."'");

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo $res = json_api(0, 'Gagal hapus data');
		} else {
			$this->db->trans_commit();
			echo $res = json_api(1, 'Berhasil hapus data');
		}   

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/device_type/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}