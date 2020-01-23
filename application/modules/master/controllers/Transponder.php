<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Transponder extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_transponder');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/transponder';
		$this->_table = 'app.t_mtr_transponder';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_transponder->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Transponder',
			'content'  => 'master/transponder/index',
			'customer' => $this->m_transponder->get_customer(),
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Add Transponder';
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');
		$date_now = date('Y-m-d');
		$count_code = $this->m_transponder->count_code($date_now)->count;
		$generate_code = "TR" . date('ymd') . sprintf("%03d",($count_code+1));

		$transponder = $this->input->post('transponder');

		$data = array(
			'transponder_name' => $transponder,
			'transponder_code' => $generate_code,
			'status' => 1,
			'created_by' => $this->session->userdata('username'),
			'created_on' => date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('transponder', 'transponder', 'required');

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} else {

			$this->db->trans_begin();
			$this->global_model->insert($this->_table,$data);

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				echo $res=json_api(0, 'Failed add data');
			}
			else
			{
				$this->db->trans_commit();
				echo $res=json_api(1, 'Success add data');
			}
		}

		 /* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/transponder/action_add';
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
		$data['title'] = 'Edit Transponder';
		$data['detail'] = $this->m_transponder->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$transponder = $this->input->post('transponder');
		$id = $this->enc->decode($this->input->post('id'));

		$this->form_validation->set_rules('transponder', 'transponder', 'required');

		$check_name = $this->m_transponder->check_data("app.t_mtr_transponder", "WHERE UPPER(transponder_name) = UPPER('$transponder')");

		$data = array(
			'transponder_name' => $transponder,
			'updated_by'=>$this->session->userdata('username'),
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} elseif ($check_name) {
			echo $res = json_api(0, 'Transponder name already exist');
		} else {
			$this->db->trans_begin();
			$this->global_model->update($this->_table, $data , "id = $id");

			if ($this->db->trans_status() === FALSE) {   
				$this->db->trans_rollback();
				echo $res = json_api(0, 'Failed update data');
			} else {
				$this->db->trans_commit();
				echo $res = json_api(1, 'Success update data');
			}
		}

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/transponder/action_edit';
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
			echo $res = json_api(0, 'Failed delete data');
		} else {
			$this->db->trans_commit();
			echo $res = json_api(1, 'Success delete data');
		}   

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/transponder/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}