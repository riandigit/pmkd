<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Supplier extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_supplier');
		$this->load->library('log_activitytxt');
		$this->_module = 'master/supplier';
		$this->_table = 'app.t_mtr_supplier';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->m_supplier->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'     => 'Home',
			'url_home' => site_url('home'),
			'title'    => 'Supplier',
			'content'  => 'master/supplier/index',
			'customer' => $this->m_supplier->get_customer(),
			'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add')),
		);

		$this->load->view('default', $data);
	}

	public function add(){
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$data['title'] = 'Add Supplier';
		$data['operator'] = $this->m_supplier->get_op();
		$this->load->view($this->_module.'/add',$data);
	}

	public function action_add()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$supplier_name = $this->input->post('supplier_name');
		$operator = $this->enc->decode($this->input->post('operator'));
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$phone = $this->input->post('phone');
		$fax = $this->input->post('fax');
		$pic = $this->input->post('pic');
		$address = $this->input->post('address');

		$param = "SUP" . sprintf("%03d",($operator));
		$count_code = $this->m_supplier->count_code($param)->count;
		$generate_code = "SUP" . sprintf("%03d",($operator)) . sprintf("%03d",($count_code+1));

		$data = array(
			'name' => $supplier_name,
			'supplier_code' => $generate_code,
			'operator_id' => $operator,
			'email' => $email,
			'mobile' => $mobile,
			'phone' => $phone,
			'fax_number' => $fax,
			'pic' => $pic,
			'address' => $address,
			'supplier_status' => 1,
			'created_by' => $this->session->userdata('username'),
			'created_on' => date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('supplier_name', 'supplier_name', 'required');

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
		$logUrl      = site_url().'master/supplier/action_add';
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
		$data['title'] = 'Edit Supplier';
		$data['operator'] = $this->m_supplier->get_op();
		$data['detail'] = $this->m_supplier->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
	}

	public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$supplier_name = $this->input->post('supplier_name');
		$operator = $this->enc->decode($this->input->post('operator'));
		$email = $this->input->post('email');
		$mobile = $this->input->post('mobile');
		$phone = $this->input->post('phone');
		$fax = $this->input->post('fax');
		$pic = $this->input->post('pic');
		$address = $this->input->post('address');

		$this->form_validation->set_rules('supplier_name', 'supplier_name', 'required');

		$check_email = $this->m_supplier->check_data("app.t_mtr_supplier", "WHERE UPPER(email) = UPPER('$email') AND id != '$id' AND supplier_status = 1");

		$data = array(
			'name' => $supplier_name,
			'operator_id' => $operator,
			'email' => $email,
			'mobile' => $mobile,
			'phone' => $phone,
			'fax_number' => $fax,
			'pic' => $pic,
			'address' => $address,
			'updated_by'=>$this->session->userdata('username'),
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} elseif ($check_email) {
			echo $res = json_api(0, 'Email name already exist');
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
		$logUrl      = site_url().'master/supplier/action_edit';
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
			'supplier_status' => -5,
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
		$logUrl      = site_url().'master/supplier/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}