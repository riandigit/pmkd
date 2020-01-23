<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Users extends MY_Controller {
	public function __construct() {
		parent::__construct();
		logged_in();
		$this->load->model('users_model');
		$this->load->library(array('bcrypt'));

		$this->_table     = 'tbl_user';
		$this->_username  = $this->session->userdata('username');
		$this->_module    = 'configuration/users';
	}

	public function index(){
		checkUrlAccess(uri_string(),'view');
		
		$data = array(
			'home'       => 'Home',
			'url_home'   => site_url('home'),
			'parent'     => 'Konfigurasi Sistem',
			'url_parent' => '#',
			'title'      => 'User',
			'content'    => 'users/index',
			'user_group' => $this->global_model->select_data("tbl_user_group","where status not in (-5) order by name asc")->result(),
			'btn_excel'  => checkBtnAccess($this->_module,'download_excel'),
			'btn_add'    => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add'))
		);

		$this->load->view ('default', $data);
	}

	public function ajaxlist_user() {
		if($this->input->is_ajax_request()){
			$rows = $this->users_model->userList();
			echo json_encode($rows);
			exit;
		}
	}

	public function add(){
		validate_ajax();
		$data['title']      = 'Tambah User';
		$data['user_group'] = $this->global_model->select_data("tbl_user_group","WHERE status = 1 order by name asc")->result();
		$data['operator'] 	= $this->users_model->dropdown_op();

		$this->load->view($this->_module.'/add',$data);
	}

	public function edit($param){
		validate_ajax();
		$data['id']         = $param;

		$data['user_group'] = $this->dropdown_user_group();
		$data['row']        = $this->global_model->selectById($this->_table, 'id', $this->enc->decode($param));
		$data['operator'] 	= $this->users_model->dropdown_op();
		$data['title']      = 'Edit User';

		$this->load->view($this->_module.'/edit',$data);
	}

	public function reset_password($param){
		validate_ajax();
		$data['id']    = $param;
		$data['title'] = 'Ganti Password';

		$this->load->view($this->_module.'/reset_password',$data);
	}

	public function action_add(){
		validate_ajax();
		$post = $this->input->post();

		$this->form_validation
		->set_rules('first_name', 'Nama Depan', 'trim|required')
		->set_rules('username', 'Username', 'trim|required')
		->set_rules('user_group', 'User Grup', 'trim|required');

		$this->form_validation->set_message('required','%s harus diisi!');
		$operator = "";
		$operator_post = $this->input->post('operator');

		if ($operator_post != "") {
			$operator = $this->enc->decode($operator_post);
		}

		$set_pass = "admin123";

		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name'); 
		$username = trim($this->input->post('username'));
		$user_group_id = $this->enc->decode($this->input->post('user_group'));
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$password = $this->bcrypt->hash_password(strtoupper(md5($set_pass)));

		$data = array(
			'first_name' => $first_name, 
			'last_name' => $last_name, 
			'username' => strtolower($username), 
			'user_group_id' =>$user_group_id,
			'phone' => $phone,
			'operator_cs_id' => $operator, 
			'email' => $email,
			'password'  => $password
		);

		// ceck username selain -5
		$check = $this->global_model->select_data($this->_table," WHERE upper(username)=upper('".$post['username']."')  and status not in (-5)" );

		if($this->form_validation->run() == FALSE) {
			$response = json_api(0,validation_errors());
		} elseif($check->num_rows()>0) {
			$response =  json_api(0,'Username sudah ada'); 
		} else {  
			$query = $this->global_model->saveData($this->_table, $data);
			if($query){
				$response = json_api(1,'Simpan Data Berhasil');
			}else{
				$response = json_encode($this->db->error()); 
			}
		}

		$this->log_activitytxt->createLog($this->_username, uri_string(), 'ADD', json_encode($data), $response); 
		echo $response;
	}

	public function action_edit(){
		validate_ajax();
		$post = $this->input->post();

		/* validation */
		$this->form_validation
		->set_rules('id', 'ID User', 'trim|required')
		->set_rules('first_name', 'Nama Depan', 'trim|required')
		->set_rules('user_group', 'User Group', 'trim|required');

		$this->form_validation->set_message('required','%s harus diisi!');

		$id = $this->enc->decode($post['id']);

		$operator = "";
		if ($post['operator'] != "") {
			$operator = $this->enc->decode($post['operator']);
		}

		$user_group = $post['user_group'];

		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name'); 
		$phone = $this->input->post('phone');
		$email =$this->input->post('email');

		$data = array(
			'first_name' => $first_name, 
			'last_name' => $last_name,
			'user_group_id' => $user_group,
			'phone' => $phone, 
			'email' => $email,
			'operator_cs_id' => $operator,
			'updated_on'=>date("Y-m-d H:i:s"),
			'updated_by'=>$this->session->userdata('username'),
		);

		$check = $this->global_model->checkData(
			$this->_table,
			array('username' => $post['username']),
			'id',$id
		);

		if($this->form_validation->run() == FALSE){
			$response = json_api(0,validation_errors());
		} elseif ($check) {
			$response =  json_api(0,'email '.$post['email'].' Sudah Ada'); 
		} else {
			$this->db->trans_begin();

			$query = $this->users_model->update_data($this->_table, $data, "id=$id");

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				$response=json_api(0, 'Gagal update data');
			}
			else
			{
				$this->db->trans_commit();
				$response=json_api(1, 'Berhasil update data');
			}   
		}

		$this->log_activitytxt->createLog($this->_username, uri_string(), 'update', json_encode($data), $response); 
		echo $response;
	}

	public function action_reset_password(){
		validate_ajax();
		$post = $this->input->post();

		/* validation */
		$this->form_validation->set_rules('password', 'Password Baru', 'trim|required');
		$this->form_validation->set_message('required','%s harus diisi!');

		$id = $this->enc->decode($post['id']);
		/* data post */
		$data = array(
			'id' => $id, 
			'password' => $this->bcrypt->hash_password(strtoupper(md5($post['password'])))
		);

		if($this->form_validation->run() == FALSE){
			$response = json_api(0,validation_errors());
		}else{
			$query = $this->global_model->updateData($this->_table, $data, 'id');
			if($query){
				$response = json_api(1,'Update Password Berhasil');
			}else{
				$response = json_encode($this->db->error()); 
			}
		}

		$this->log_activitytxt->createLog($this->_username, uri_string(), 'UPDATE', json_encode($data), $response); 
		echo $response;
	}

	public function action_delete($param){
		validate_ajax();
		$id = $this->enc->decode($param);

		$data = array(
			'id' => $id,
			'status' => -5
		);

		$query = $this->global_model->updateData($this->_table, $data, 'id');

		if($query){
			$response = json_api(1,'Delete Data Berhasil');
		}else{
			$response = json_encode($this->db->error()); 
		}

		$this->log_activitytxt->createLog($this->_username, uri_string(), 'DELETE', json_encode($data), $response);
		echo $response;
	}

	function dropdown_user_group(){
		$datas    = $this->global_model->selectAll('tbl_user_group');
		$data[''] = '';

		if($datas){
			foreach($datas as $row){
				$data[$row->id] = $row->name;
			}
		}
		
		return $data;
	}

	public function enable($param)
	{
		validate_ajax();
		$p = $this->enc->decode($param);

		$d = explode('|', $p);

		/* data */
		$data = array(
			'status' => $d[1],
			'updated_on'=>date("Y-m-d H:i:s"),
			'updated_by'=>$this->session->userdata('username'),
		);


		$this->db->trans_begin();
		$this->users_model->update_data($this->_table,$data,"id=".$this->enc->decode($d[0]));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo $res=json_api(0, 'Gagal aktifkan data');
		}
		else
		{
			$this->db->trans_commit();
			echo $res=json_api(1, 'Berhasil aktifkan data');
		}


		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'configuration/user/enable';
		$logMethod   = 'ENABLED';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

	public function disable($param)
	{
		validate_ajax();
		$p = $this->enc->decode($param);

		$d = explode('|', $p);

		/* data */
		$data = array(
			'status' => $d[1],
			'updated_on'=>date("Y-m-d H:i:s"),
			'updated_by'=>$this->session->userdata('username'),
		);


		$this->db->trans_begin();
		$this->users_model->update_data($this->_table,$data,"id=".$this->enc->decode($d[0]));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo $res=json_api(0, 'Gagal dinonaktifkan data');
		}
		else
		{
			$this->db->trans_commit();
			echo $res=json_api(1, 'Data berhasil dinonaktifkan ');
		} 

		/* Fungsi Create Log */
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'configuration/user/enable';
		$logMethod   = 'DISABLED';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}

}