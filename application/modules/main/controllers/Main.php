<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_main', 'model');
        $this->_table = 'tbl_user';
        $this->load->library(array('bcrypt'));
        $this->load->model('M_global', '_model');

        // $this->load->library(array('bcrypt', 'curl', 'form_validation', 'session'));
        // $this->load->helper('captcha');
    }
    public function index()
    {
        $data['gbkp'] = $this->model->Gbkp();
        // var_dump($data);exit;
        $this->load->view('index', $data);
    }
    function asal($qry)
    {
        $city = array();
        foreach ($qry as $row) {
            $data['id_seq'] = $this->enc->encode($row->id_seq);
            $data['name'] = $row->nama;

            $city[] = $data;
        }


        return $city;
    }
    public function action_add()
    {
        validate_ajax();
        $post = $this->input->post();
        $nik = strtoupper($post['nik']);
        $nama = strtoupper($post['nama']);
        $runggun = strtoupper($post['runggun']);

        $gbkp = $this->enc->decode($post['gbkp']);

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
            'asal_gereja' => $gbkp,
            'username' => $username,
            'user_group_id' => 3,
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
            } else if (!$check && !$check2) {
                $query = $this->global_model->saveData($this->_table, $data);
                if ($query) {
                    $response = json_api(1, 'Simpan Data Berhasil, silahlah login');
                } else {
                    $response = json_encode($this->db->error());
                }
            } else {
                $response =  json_api(0, 'username ' . $post['nama'] . ' Sudah Ada');
            }
        }

        echo $response;
    }

    public function data()
    {
        // validate_ajax();
        logged_in();
        $id =  $this->session->userdata('id');
        $data['row'] = $this->model->getAkun($id);
        $data['pekerjaan'] = $this->model->getPekerjaan();
        $data['pendidikan'] = $this->model->getPendidikan();
        if ($data['row']->runggun == '') {
            $data['row']->runggun = $data['row']->asal_gereja;
        }
        $this->load->view('biodata', $data);
    }
    public function action_update()
    {
        validate_ajax();
        $post = $this->input->post();
        $id = strtoupper($post['id']);
        $nama = strtoupper($post['nama']);
        $tempatlahir = strtoupper($post['tempatlahir']);
        $tanggallahir = date("Y-m-d", strtotime($post['tanggallahir']));
        $nohp = strtoupper($post['nohp']);
        $email = strtoupper($post['email']);
        $pekerjaan = $this->enc->decode($post['pekerjaan']);
        $pendidikan = $this->enc->decode($post['pendidikan']);
        $domisili = $post['domisili'];
        $anggota= $post['keanggotaan'];
        $jk = $post['jk'];
        /* validation */
        $this->form_validation->set_rules('tempatlahir', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('tanggallahir', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('nohp', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('email', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'Nama Grup', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi!');
        $data = array(
            'tempat_lahir' => $tempatlahir,
            'tanggal_lahir' => $tanggallahir,
            'phone' => $nohp,
            'email' => $email,
            'domisili' => $domisili,
            'jk' => $jk,
            'pendidikan' =>$pendidikan,
            'pekerjaan' =>  $pekerjaan,
            'updated_by' => $nama,
            'status_user' => 2,
            'keanggotaan' => $anggota,
        );

        if ($this->form_validation->run() == FALSE) {
            $response = json_api(0, validation_errors());
        } else {
            $insert = $this->_model->delete($id, $data, 'tbl_user', 'id');

            if ($insert) {
                $response =  json_api(1, 'Data Succesfull Saved, tunggu sampai konfirmasi dari runggun');
            } else {

                $response = json_encode($this->db->error());
            }
        }


        echo $response;
    }
}
