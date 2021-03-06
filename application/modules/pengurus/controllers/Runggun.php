<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Runggun extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        logged_in();

        $this->load->model('M_runggun', 'model');
        $this->load->model('M_global', '_model');
        $this->load->model('M_anggota', 'modelanggota');

        $this->_table    = 'tbl_user_group';
        $this->_username = $this->session->userdata('username');
        $this->load->library(array('bcrypt'));
        $this->_runggun = $this->session->userdata('operator_id');
        $this->_module   = 'pengurus/runggun';
    }
    public function index()
    {
        checkUrlAccess(uri_string(), 'view');
        if ($this->input->is_ajax_request()) {
            $rows = $this->group_model->groupList();
            echo json_encode($rows);
            exit;
        }

        $data = array(
            'home'        => 'Home',
            'url_home'    => site_url('home'),
            'parent'      => 'Pengurus',
            'url_parent'  => '#',
            'title'       => 'Runggun',
            'content'     => 'runggun/index',
            'btn_add'     => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add'))
        );

        $this->load->view('default', $data);
    }
    public function Runggunlist()
    {
        validate_ajax();
        $list = $this->model->getDataRunggun();
        echo json_encode($list);
    }
    public function add()
    {
        validate_ajax();
        $data['gbkp'] = $this->model->getGbkp();
        $data['title'] = "Add Runggun";

        $data['pendidikan'] = $this->modelanggota->getPendidikan();
        $data['pekerjaan'] = $this->modelanggota->getPekerjaan();
        // $data['menu'] = $this->m_global->getMenu($this->session->userdata('group_id'));
        $this->load->view('runggun/add', $data);
    }
    public function saveRunggun()
    {
        validate_ajax();
        $post = $this->input->post();
        $nik = strtoupper($post['nik']);
        $nama = strtoupper($post['nama']);
        $tempatlahir = strtoupper($post['tempatlahir']);
        $tanggallahir = date("Y-m-d", strtotime($post['tanggallahir']));
        $nohp = strtoupper($post['hp']);
        $email = strtoupper($post['email']);
        $pekerjaan = $this->enc->decode($post['pekerjaan']);
        $alamat = $post['alamat'];
        $statusanggota = "Anggota Biasa";
        $pendidikan = $this->enc->decode($post['pendidikan']);
        $domisili = $post['domisili'];
        $asalgereja = $this->enc->decode($post['gbkp']);
        $username = $post['username'];
        $anggota = $post['anggota'];
        $password = $this->bcrypt->hash_password(strtoupper(md5($post['password'])));

        $jk = $post['jk'];

        $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'tempat_lahir' => $tempatlahir,
            'tanggal_lahir' => $tanggallahir,
            'alamat' => $alamat,
            'domisili' => $domisili,
            'tanggal_lahir' => $tanggallahir,
            'phone' => $nohp,
            'email' => $email,
            'domisili' => $domisili,
            'jk' => $jk,
            'keanggotaan' => $anggota,
            'username' => $username,
            'status_anggota' => $statusanggota,
            'password' => $password,
            'pendidikan' => $pendidikan,
            'pekerjaan' => $pekerjaan,
            'asal_gereja' => $asalgereja,
            'updated_by' => $nama,
            'status_user' => 1,
            'runggun_id' => $asalgereja,
            'operator_id' => $asalgereja,
            'user_group_id' => 2,
            'status' => 1
        );
        $insert = $this->model->insert('tbl_user', $data);

        if ($insert) {
            $response =  json_api(1, 'Data Operator Berhasil Disimpan');
        } else {
            $response = json_encode($this->db->error());
        }

        $file = array('ADD', 'LANE', $this->_username, json_encode($data));

        $this->log_activity_txt->startLog($file, array('app.t_mtr_operator'));

        echo $response;
    }
    private function _deleteImage($name)
    {
        if (file_exists(PUBPATH . "assets/img/fotoanggota/" . $name)) {
            return    unlink(PUBPATH . "assets/img/fotoanggota/" . $name);
        } else {
            return true;
        }
    }
    function editRunggun($ids)
    {

        validate_ajax();
        $id = $this->enc->decode($ids);
        $data['title'] = "Edit User Runggun";

        $data['pendidikan'] = $this->modelanggota->getPendidikan();
        $data['pekerjaan'] = $this->modelanggota->getPekerjaan();
        $data['gbkp'] = $this->model->getGbkp();
        $data['row'] = $this->model->getRungguns($id);
        $this->load->view('Runggun/edit', $data);
    }
    public function saveEdit()
    {
        validate_ajax();
        $post = $this->input->post();
        $id = strtoupper($post['id']);
        $nik = strtoupper($post['nik']);
        $nama = strtoupper($post['nama']);
        $tempatlahir = strtoupper($post['tempatlahir']);
        $tanggallahir = date("Y-m-d", strtotime($post['tanggallahir']));
        $nohp = strtoupper($post['hp']);
        $email = strtoupper($post['email']);
        $pekerjaan = $this->enc->decode($post['pekerjaan']);
        $alamat = $post['alamat'];
        $pendidikan = $this->enc->decode($post['pendidikan']);
        $domisili = $post['domisili'];
        $asalgereja = $this->enc->decode($post['gbkp']);
        $jk = $post['jk'];
        $anggota = $post['anggota'];

        $username = $post['username'];
        /* validation */
        $this->form_validation->set_rules('tempatlahir', 'TEMPAT', 'trim|required');
        $this->form_validation->set_rules('tanggallahir', 'TANGGAL', 'trim|required');
        $this->form_validation->set_rules('hp', 'HP', 'trim|required');
        // $this->form_validation->set_rules('gbkp', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required');
        // $this->form_validation->set_rules('gbkptext', 'Nama Grup', 'trim|required');
        $this->form_validation->set_rules('pekerjaan', 'PEKERJAAN', 'trim|required');
        $this->form_validation->set_rules('pendidikan', 'PENDIDIKAN', 'trim|required');
        $this->form_validation->set_message('required', '%s harus diisi!');


        $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'alamat' => $alamat,
            'tempat_lahir' => $tempatlahir,
            'tanggal_lahir' => $tanggallahir,
            'phone' => $nohp,
            'email' => $email,
            'domisili' => $domisili,
            'jk' => $jk,
            'keanggotaan' => $anggota,
            'pendidikan' => $pendidikan,
            'pekerjaan' =>$pekerjaan ,
            'username' => $username,
            'asal_gereja' => $asalgereja,
            'updated_by' => $nama,
            'status_user' => 1,
        );

        if ($this->form_validation->run() == FALSE) {
            $response = json_api(0, validation_errors());
        } else {

            $insert = $this->_model->delete($id, $data, 'tbl_user', 'id');

            if ($insert) {
                $response =  json_api(1, 'Data Succesfull Saved');
            } else {

                $response = json_encode($this->db->error());
            }
        }


        echo $response;
    }
    public function deleteRunggun($id)
    {

        validate_ajax();
        $id = $this->enc->decode($id);
        $data = array(
            'status' => -5,
            'updated_by' => $this->session->userdata('username'),
            'updated_on' => date("Y-m-d H:i:s"),
        );

        $deleted  = $this->_model->delete($id, $data, 'tbl_user', 'id');
        if ($deleted) {
            $response =  json_api(1, 'Data Successfull Deleted');
        } else {

            $response = json_encode($this->db->error());
        }
        $data['operator_id'] = $id;


        $file = array('DELETE', 'OPERATOR', $this->_username, json_encode($data));

        $this->log_activity_txt->startLog($file, array('app.t_mtr_operator'));
        echo $response;
    }
}
