<?php
defined('BASEPATH') or exit('No direct script access allowed');

class City extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_city', 'model');
        $this->load->model('m_province', 'model_province');
        $this->load->library('log_activitytxt');
        $this->_username =  $this->session->userdata('username');
		$this->load->model('m_global', '_model');   
        $this->_module = 'master/city';
        $this->_table = 'app.t_mtr_city';
    }
    public function index()
    { 
        checkUrlAccess(uri_string(), 'view');

        $data = array(
            'home'     => 'Home',
            'url_home' => site_url('home'),
            'title'    => 'City',
            'content'  => 'master/city/index',
            'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add')),
        );

        $this->load->view('default', $data);
    }
    public function Citylist()
    {
        validate_ajax();
        $rows = $this->model->dataListcity();
        echo json_encode($rows);
    }
    public function add(){
        validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');
        $data['island'] = $this->model_province->getIsland();
		$data['title'] = 'Add City';
		$this->load->view($this->_module.'/add',$data);
    }
    public function action_add(){
        
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$province = $this->input->post('province');
		$name = $this->input->post('city');
		$data = array(
			'id_province' => $this->enc->decode($province),
			'name' => $name,
			'status' => 1,
			'created_by' => $this->_username,
			'created_on' => date("Y-m-d H:i:s"),
		);
		$this->form_validation->set_rules('province', 'province', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');

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
    public function getProvince($idisland)
	{


		$province = $this->_model->getProvince($this->enc->decode($idisland));
		// var_dump($segment);exit;
		$provinsi = array();
		foreach ($province as $row) {
			$data['id_seq'] = $this->enc->encode($row->id_seq);
			$data['name'] = $row->name;

			$provinsi[] = $data;
		}
		$this->log_activitytxt->createLog($this->_username, uri_string(), 'getProvince', json_encode($provinsi), 'success get province');
		echo json_encode($provinsi);
	}
    public function edit($id)
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($id);
		$data['title'] = 'Edit City';
        $data['row'] = $this->model->get_edit($id);
        $data['id']= $id;
		$data['island'] = $this->model_province->getIsland();
		$data['province'] = $this->model->getProvince();

		$this->load->view($this->_module.'/edit',$data);
    }
    public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$province = $this->enc->decode($this->input->post('province'));
        
		$name = $this->input->post('city');
		$this->form_validation->set_rules('island', 'island', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');

		$data = array(
			'id_province' => $province,
			'name' => $name,
			'updated_by'=>$this->_username,
			'updated_on'=>date("Y-m-d H:i:s"),
		);
        // var_dump($id);exit;
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
		$createdBy   = $this->session->userdata('username');
		$logUrl      = site_url().'master/city/action_edit';
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
		$logUrl      = site_url().'master/City/action_delete';
		$logMethod   = 'DELETE';
		$logParam    = json_encode($data);
		$logResponse = $res;

		$this->log_activitytxt->createLog($createdBy, $logUrl, $logMethod, $logParam, $logResponse);
	}
}
