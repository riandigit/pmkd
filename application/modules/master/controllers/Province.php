<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Province extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_province', 'model');
        $this->load->library('log_activitytxt');
        $this->_module = 'master/province';
        $this->_table = 'app.t_mtr_province';
        $this->_username =  $this->session->userdata('username');

    }
    public function index()
    {  
        checkUrlAccess(uri_string(), 'view');

        $data = array(
            'home'     => 'Home',
            'url_home' => site_url('home'),
            'title'    => 'Province',
            'content'  => 'master/province/index',
            'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add')),
        );

        $this->load->view('default', $data);
    }
    public function Provincelist()
    {
        validate_ajax();
        $rows = $this->model->dataListprovince();
        echo json_encode($rows);
    }
    public function add(){
        validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

        $data['title'] = 'Add Province';
        $data['island'] = $this->model->getIsland();
		$this->load->view($this->_module.'/add',$data);
    }
    public function action_add(){
        
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$island = $this->input->post('island');
		$name = $this->input->post('Province');
		$data = array(
			'id_island' => $this->enc->decode($island),
			'name' => $name,
			'status' => 1,
			'created_by' => $this->_username,
			'created_on' => date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('island', 'island', 'required');
		$this->form_validation->set_rules('Province', 'Province', 'required');

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
		$createdBy   = $this->_username;
		$logUrl      = site_url().'master/province/action_add';
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
        $data['id']=$id;
		$data['title'] = 'Edit Province';
		$data['row'] = $this->model->get_edit($id);
		$data['island'] = $this->model->getIsland();

		$this->load->view($this->_module.'/edit',$data);
    }
    public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$island = $this->enc->decode($this->input->post('island'));
		$province = $this->input->post('province');

		$this->form_validation->set_rules('island', 'island', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');

		$data = array(
			'id_island' => $island,
			'name' => $province,
			'updated_by'=>$this->_username,
			'updated_on'=>date("Y-m-d H:i:s"),
		);

		if($this->form_validation->run() === false)
		{
			echo $res = json_api(0, 'There is empty data');
		} else {
			$this->db->trans_begin();
			$this->global_model->update($this->_table, $data , "id_seq = $id");

			if ($this->db->trans_status() === FALSE) {   
				$this->db->trans_rollback();
				echo $res = json_api(0, 'Failed update data');
			} else {
				$this->db->trans_commit();
				echo $res = json_api(1, 'Success update data');
			}
		}

		/* Fungsi Create Log */
		$createdBy   = $this->_username;
		$logUrl      = site_url().'master/province/action_edit';
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
			'updated_by' => $this->_username,
		);

		$id = $this->enc->decode($id);

		$this->db->trans_begin();
		$this->global_model->update($this->_table, $data, " id_seq='".$id."'");

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo $res = json_api(0, 'Failed delete data');
		} else {
			$this->db->trans_commit();
			echo $res = json_api(1, 'Success delete data');
		}   

		/* Fungsi Create Log */
		$createdBy   = $this->_username;
		$logUrl      = site_url().'master/Province/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}
}
