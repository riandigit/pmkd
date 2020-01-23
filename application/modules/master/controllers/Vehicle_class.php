<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Vehicle_class extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_vehicle_class');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/vehicle_class';
		$this->_table = 'app.t_mtr_vehicle_class';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_vehicle_class->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Golongan Kendaraan',
			'content'  => 'master/vehicle_class/index',
			'customer' => $this->m_vehicle_class->get_customer(),
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Tambah Golongan';
		$data['customer'] = $this->m_vehicle_class->get_customer();
		$data['vehicle_class'] = $this->m_vehicle_class->get_class();
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$name = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');
		$desc = $this->input->post('desc');

		$check_name = $this->global_model->select_data("app.t_mtr_vehicle_class"," WHERE UPPER(vehicle_class_name) = UPPER('$name') AND status = 1 ")->result();

		if ($check_name) {
			echo $res = json_api(0, 'Nama golongan sudah ada');
			exit;
		}

		$param = "VHC1";
		$count_code = $this->m_vehicle_class->count_code($param)->count;
		$generate_code = "VHC1" . sprintf("%04d",($count_code+1));

		$this->form_validation->set_rules('name', 'name', 'required');

		$data = array(
			'vehicle_class_code' => $generate_code,
			'vehicle_class_name' => $name,
			'desc' => $desc,
			'min_length' => $min,
			'max_length' => $max,
			'status' => 1,
			'created_by'=>$this->session->userdata('username'),
			'created_on'=>date("Y-m-d H:i:s"),
		);

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
		$logUrl      = site_url().'master/vehicle_class/action_add';
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
		$data['title'] = 'Edit Golongan';
		$data['detail'] = $this->m_vehicle_class->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$name = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');
		$desc = $this->input->post('desc');

		$check_name = $this->global_model->select_data("app.t_mtr_vehicle_class"," WHERE UPPER(vehicle_class_name) = UPPER('$name') AND status = 1 AND id_seq != $id")->result();

		if ($check_name) {
			echo $res = json_api(0, 'Nama golongan sudah ada');
			exit;
		}

		$this->form_validation->set_rules('name', 'name', 'required');

		$data = array(
			'vehicle_class_name' => $name,
			'min_length' => $min,
			'max_length' => $max,
			'desc' => $desc,
			'updated_by'=>$this->session->userdata('username'),
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'Ada data kosong');
		} else {
			$this->db->trans_begin();
			$this->global_model->update($this->_table, $data , "id_seq = $id");

			if ($this->db->trans_status() === FALSE) {   
				$this->db->trans_rollback();
				echo $res = json_api(0, 'Gagal update data');
			} else {
				$this->db->trans_commit();
				echo $res = json_api(1, 'Berhasil update data');
			}
		}

		 /* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/vehicle_class/action_edit';
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
		$this->global_model->update($this->_table, $data, " id_seq='".$id."'");

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
		$logUrl      = site_url().'master/vehicle_class/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}