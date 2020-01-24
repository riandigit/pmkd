<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_main', 'model');
        $this->_table='tbl_user';
		$this->load->library(array('bcrypt'));

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
        $nik = strtoupper($post['nik']);
        $nama = strtoupper($post['nama']);
        $runggun = strtoupper($post['runggun']);
        if($post['gbkp']!=0){
            $gbkp = $this->enc->decode($post['gbkp']);
        }
        else{
            $gbkp = $post['gbkp'];
        }
        $gbkptext = $post['gbkptext'];
        $alamat = $post['alamat'];
        $username = $post['username'];
        $password = $this->bcrypt->hash_password(strtoupper(md5($post['password'])));


        /* validation */
        $this->form_validation->set_rules('nama', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('nik', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('runggun', 'Nama Grup', 'trim|required');
        // $this->form_validation->set_rules('gbkp', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Nama Grup', 'trim|required');
        // $this->form_validation->set_rules('gbkptext', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('username', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('password', 'Nama Grup', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi!');
        $statusanggota = '';
        if ($runggun == 1) {
            $statusanggota = 'Anggota Biasa';
        } else {
            $statusanggota = 'Anggota Luar Biasa';
        }
        /* data post */
        $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'runggun_id' => $gbkp,
            'alamat' => $alamat,
            'status_anggota' => $statusanggota,
            'asal_gereja' => $gbkptext,
            'username' => $username,
            'user_group_id' => 1,
            'operator_id' => $gbkp,
            'password' => $password,
            'created_by' => $nama,
            'status' => 1,
            'status_user' => 3,
        );

        if ($this->form_validation->run() == FALSE) {
            $response = json_api(0, validation_errors());
        } else {
            $check = $this->global_model->checkData($this->_table, array('UPPER(nama)' => $nama));
            $check2 = $this->global_model->checkData($this->_table, array('UPPER(username)' => $username));
            if ($check && !$check2) {
                $response =  json_api(0, 'Nama ' . $post['name'] . ' Sudah Ada');
            } else if(!$check && !$check2) {
                $query = $this->global_model->saveData($this->_table, $data);
                if ($query) {
                    $response = json_api(1, 'Simpan Data Berhasil, silahlah login');
                } else {
                    $response = json_encode($this->db->error());
                }
            }else{
                $response =  json_api(0, 'username ' . $post['nama'] . ' Sudah Ada');

            }
        }

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
