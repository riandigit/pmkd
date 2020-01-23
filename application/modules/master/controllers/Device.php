<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Device extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_device');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/device';
		$this->_table = 'app.t_mtr_device';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_device->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Perangkat',
			'device_type' => $this->global_model->select_data("app.t_mtr_device_type"," WHERE status = 1 ")->result(),
			'content'  => 'master/device/index',
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Tambah Perangkat';
		$data['device_type'] = $this->global_model->select_data("app.t_mtr_device_type"," WHERE status = 1 ")->result();
		$data['operator'] = $this->global_model->select_data("app.t_mtr_operator"," WHERE operator_status = 1 ")->result();
		$data['lane'] = $this->m_device->dropdown_lane();
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$name = $this->input->post('name');
		$device_type = $this->enc->decode($this->input->post('device_type'));
		$operator = $this->enc->decode($this->input->post('operator'));
		$lane = $this->enc->decode($this->input->post('lane'));

		$data = array(
			'device_name' => $name,
			'device_type_id' => $device_type,
			'operator_id' => $operator,
			'lane_id' => $lane,
			'status' => 1,
			'created_by' => $this->session->userdata('username'),
			'created_on' => date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('device_type', 'device_type', 'required');
		$this->form_validation->set_rules('operator', 'operator', 'required');
		$this->form_validation->set_rules('lane', 'lane', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

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
		$logUrl      = site_url().'master/device/action_add';
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
		$data['title'] = 'Edit Perangkat';
		$data['device_type'] = $this->global_model->select_data("app.t_mtr_device_type"," WHERE status = 1 ")->result();
		$data['operator'] = $this->global_model->select_data("app.t_mtr_operator"," WHERE operator_status = 1 ")->result();
		$data['lane'] = $this->m_device->dropdown_lane();
		$data['detail'] = $this->m_device->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$name = $this->input->post('name');
		$device_type = $this->enc->decode($this->input->post('device_type'));
		$operator = $this->enc->decode($this->input->post('operator'));
		$lane = $this->enc->decode($this->input->post('lane'));

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('device_type', 'device_type', 'required');
		$this->form_validation->set_rules('operator', 'operator', 'required');
		$this->form_validation->set_rules('lane', 'lane', 'required');

		$this->form_validation->set_message('required','%s harus diisi!');

		$data = array(
			'device_name' => $name,
			'device_type_id' => $device_type,
			'operator_id' => $operator,
			'lane_id' => $lane,
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
				echo $res = json_api(0, 'Failed update data');
			} else {
				$this->db->trans_commit();
				echo $res = json_api(1, 'Success update data');
			}
		}

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/device/action_edit';
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
		$logUrl      = site_url().'master/device/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}