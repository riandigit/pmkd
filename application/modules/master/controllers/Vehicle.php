<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Vehicle extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_vehicle');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/vehicle';
		$this->_table = 'app.t_mtr_vehicle';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_vehicle->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Vehicle',
			'content'  => 'master/vehicle/index',
			'customer' => $this->m_vehicle->get_customer(),
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Add Vehicle';
		$data['customer'] = $this->m_vehicle->get_customer();
		// $data['vehicle_class'] = $this->m_vehicle->get_class();
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$plate_number = str_replace(' ', '', $this->input->post('plate_number'));
		$stnk = $this->input->post('stnk');
		$vehicle_brand = $this->input->post('vehicle_brand');
		$vehicle_color = $this->input->post('vehicle_color');
		$manufacture_year = $this->input->post('manufacture_year');
		$vehicle_cylinder = $this->input->post('vehicle_cylinder');
		$owner_name = $this->input->post('owner_name');
		$customer_id = $this->enc->decode($this->input->post('customer'));
		// $vehicle_type = $this->enc->decode($this->input->post('vehicle_type'));

		$data = array(
			'plate_number' => $plate_number,
			'customer_id' => $customer_id,
			'stnk' => $stnk,
			'vehicle_brand' => $vehicle_brand,
			'vehicle_color' => $vehicle_color,
			'manufacture_year' => $manufacture_year,
			'vehicle_cylinder' => $vehicle_cylinder,
			'owner_name' => $owner_name,
			// 'vehicle_type' => $vehicle_type,
			'vehicle_status' => 1,
			'created_by'=>$this->session->userdata('username'),
			'created_on'=>date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('plate_number', 'plate_number', 'required');
		$this->form_validation->set_rules('stnk', 'stnk', 'required');
		$this->form_validation->set_rules('vehicle_brand', 'vehicle_brand', 'required');
		$this->form_validation->set_rules('vehicle_color', 'vehicle_color', 'required');
		$this->form_validation->set_rules('manufacture_year', 'manufacture_year', 'required');
		$this->form_validation->set_rules('vehicle_cylinder', 'vehicle_cylinder', 'required');
		$this->form_validation->set_rules('owner_name', 'owner_name', 'required');
		$this->form_validation->set_rules('customer', 'customer', 'required');
		// $this->form_validation->set_rules('vehicle_type', 'vehicle_type', 'required');

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
		$logUrl      = site_url().'master/vehicle/action_add';
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
		$data['title'] = 'Edit Obu';
		$data['customer'] = $this->m_vehicle->get_customer();
		// $data['vehicle_class'] = $this->m_vehicle->get_class();
		$data['detail'] = $this->m_vehicle->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$plate_number = str_replace(' ', '', $this->input->post('plate_number'));
		$stnk = $this->input->post('stnk');
		$vehicle_brand = $this->input->post('vehicle_brand');
		$vehicle_color = $this->input->post('vehicle_color');
		$manufacture_year = $this->input->post('manufacture_year');
		$vehicle_cylinder = $this->input->post('vehicle_cylinder');
		$owner_name = $this->input->post('owner_name');
		$customer_id = $this->enc->decode($this->input->post('customer'));
		// $vehicle_type = $this->enc->decode($this->input->post('vehicle_type'));

		$vehicle_id = $this->enc->decode($this->input->post('vehicle_id'));

		$this->form_validation->set_rules('plate_number', 'plate_number', 'required');
		$this->form_validation->set_rules('stnk', 'stnk', 'required');
		$this->form_validation->set_rules('vehicle_brand', 'vehicle_brand', 'required');
		$this->form_validation->set_rules('vehicle_color', 'vehicle_color', 'required');
		$this->form_validation->set_rules('manufacture_year', 'manufacture_year', 'required');
		$this->form_validation->set_rules('vehicle_cylinder', 'vehicle_cylinder', 'required');
		$this->form_validation->set_rules('owner_name', 'owner_name', 'required');
		$this->form_validation->set_rules('customer', 'customer', 'required');
		// $this->form_validation->set_rules('vehicle_type', 'vehicle_type', 'required');

		$check_plate = $this->m_vehicle->check_data("app.t_mtr_vehicle", "WHERE plate_number = '$plate_number' AND vehicle_id != $vehicle_id");
		$check_stnk = $this->m_vehicle->check_data("app.t_mtr_vehicle", "WHERE stnk = '$stnk' AND vehicle_id != $vehicle_id");

		$data = array(
			'plate_number' => $plate_number,
			'customer_id' => $customer_id,
			'stnk' => $stnk,
			'vehicle_brand' => $vehicle_brand,
			'vehicle_color' => $vehicle_color,
			'manufacture_year' => $manufacture_year,
			'vehicle_cylinder' => $vehicle_cylinder,
			'owner_name' => $owner_name,
			// 'vehicle_type' => $vehicle_type,
			'updated_by'=>$this->session->userdata('username'),
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} else if ($check_plate) {
			echo $res = json_api(0, 'Plate number already exist');      
		} else if ($check_stnk) {
			echo $res = json_api(0, 'STNK already exist');      
		} else {
			$this->db->trans_begin();
			$this->global_model->update($this->_table, $data , "vehicle_id = $vehicle_id");

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
		$logUrl      = site_url().'master/vehicle/action_edit';
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
			'vehicle_status' => -5,
			'updated_on' => date("Y-m-d H:i:s"),
			'updated_by' => $this->session->userdata('username'),
		);

		$id = $this->enc->decode($id);

		$this->db->trans_begin();
		$this->global_model->update($this->_table, $data, " vehicle_id='".$id."'");

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
		$logUrl      = site_url().'master/vehicle/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}