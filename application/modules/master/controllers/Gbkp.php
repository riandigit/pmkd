<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gbkp extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_username =  $this->session->userdata('username');
		$this->load->model('m_global', '_model');   
		$this->load->model('m_gbkp', 'model');   
        $this->_module = 'master/gbkp';
        $this->_table ='tbl_gbkp';
    }
    public function index()
    { 
        checkUrlAccess(uri_string(), 'view');

        $data = array(
            'home'     => 'Home',
            'url_home' => site_url('home'),
            'title'    => 'Gbkp',
            'content'  => 'master/Gbkp/index',
            'btn_add'  => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add')),
        );

        $this->load->view('default', $data);
    }
    public function Gbkplist()
    {
        validate_ajax();
        $rows = $this->model->dataListgbkp();
        echo json_encode($rows);
    }
    public function add(){
        validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');
		$data['title'] = 'Add Gbkp';
		$this->load->view($this->_module.'/add',$data);
    }
    public function action_add(){
        
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'add');

		$name = $this->input->post('nama');
		$data = array(
			'nama' => $name,
			'status' => 1,
			'created_by' => $this->_username,
			'created_on' => date("Y-m-d H:i:s"),
		);
		$this->form_validation->set_rules('nama', 'nama', 'required');

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
    }
    public function edit($id)
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

        $id = $this->enc->decode($id);
        $data['id']=$id;
        
		$data['title'] = 'Edit Gbkp';
		$data['row'] = $this->model->get_edit($id);

		$this->load->view($this->_module.'/edit',$data);
    }
    public function action_edit()
	{
		validate_ajax();
		$this->global_model->checkAccessMenuAction($this->_module,'edit');

		$id = $this->enc->decode($this->input->post('id'));
		$nama = $this->input->post('nama');

		$this->form_validation->set_rules('nama', 'nama', 'required');

		$data = array(
			'nama' => $nama,
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

	}

}