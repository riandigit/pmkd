<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_main', 'model');
        // $this->load->library(array('bcrypt', 'curl', 'form_validation', 'session'));
        // $this->load->helper('captcha');
    }
    public function index()
    {
        $this->load->view('index');
    }
    public function action_add()
    {
        validate_ajax();
        $post = $this->input->post();
        $name = strtoupper($post['name']);

        /* validation */
        $this->form_validation->set_rules('name', 'Nama Grup', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi!');

        /* data post */
        $data = array(
            'name' => $name,
            'status' => 1
        );

        if ($this->form_validation->run() == FALSE) {
            $response = json_api(0, validation_errors());
        } else {
            $check = $this->global_model->checkData($this->_table, array('UPPER(name)' => $name));
            if ($check) {
                $response =  json_api(0, 'Nama Grup ' . $post['name'] . ' Sudah Ada');
            } else {
                $query = $this->global_model->saveData($this->_table, $data);
                if ($query) {
                    $response = json_api(1, 'Simpan Data Berhasil');
                } else {
                    $response = json_encode($this->db->error());
                }
            }
        }

        $this->log_activitytxt->createLog($this->_username, uri_string(), 'ADD', json_encode($data), $response);
        echo $response;
    }
    public function getGbkp()
    {
        validate_ajax();
        $gbkp = $this->model->Gbkp();

        $city = array();
        foreach ($gbkp as $row) {
            $data['id_seq'] = $this->enc->encode($row->id_seq);
            $data['name'] = $row->nama;

            $city[] = $data;
        }
        echo json_encode($city);
    }
}
