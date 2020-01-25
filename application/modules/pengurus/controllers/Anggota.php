<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
        $this->load->library(array('bcrypt'));
		logged_in();
		$this->load->model('M_global', '_model');

		$this->load->model('M_anggota', 'model');
		$this->_table    = 'tbl_user_group';
		$this->_username = $this->session->userdata('username');
		$this->_runggun = $this->session->userdata('runggun_id');
		$this->_module   = 'pengurus/anggota';
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
			'parent'      => 'Anggota',
			'url_parent'  => '#',
			'title'       => 'Anggota',
			'content'     => 'anggota/index',
			'btn_add'     => generate_button_new($this->_module, 'add',  site_url($this->_module . '/add'))
		);

		$this->load->view('default', $data);
	}

	public function Anggotalist()
	{
		validate_ajax();
		$list = $this->model->getDataOperator($this->enc->decode($this->_runggun));
		echo json_encode($list);
	}
	public function add()
	{
		validate_ajax();
		$data['gbkp'] = $this->model->getGbkp();
		$data['title'] = "Add Anggota";
		$this->load->view('anggota/add', $data);
	}
	public function saveAnggota()
	{
		validate_ajax();
		$post = $this->input->post();
		// $id = strtoupper($post['id']);
		$nik = strtoupper($post['nik']);
		$nama = strtoupper($post['nama']);
		$tempatlahir = strtoupper($post['tempatlahir']);
		$tanggallahir = date("Y-m-d", strtotime($post['tanggallahir']));
		$nohp = strtoupper($post['hp']);
		$email = strtoupper($post['email']);
		$pekerjaan = $post['pekerjaan'];
		$alamat = $post['alamat'];
		$statusanggota = "Anggota Biasa";
		$pendidikan = $post['pendidikan'];
		$domisili = $post['domisili'];
		$asalgereja = $this->enc->decode($post['gbkp']);
		$username = $post['username'];
		$password = $this->bcrypt->hash_password(strtoupper(md5($post['password'])));

		$jk = $post['jk'];
		$path = $_FILES['image']['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$name = $nama . time() . '.' . $ext;
		$config['upload_path']          = './assets/img/fotoanggota/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['file_name']            = $name;
		$config['overwrite']            = true;
		$config['max_size']             = 1024; // 1MB
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		if (!is_dir('assets/img/fotoanggota/')) {
			mkdir('./assets/img/fotoanggota/', 0777, TRUE);
		}
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('image')) {
			$filename = $this->upload->data("file_name");
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
				'foto' => $filename,
				'username' => $username,
				'status_anggota' => $statusanggota,
				'password' => $password,
				'pendidikan' => $pekerjaan,
				'pekerjaan' => $pendidikan,
				'asal_gereja' => $asalgereja,
				'updated_by' => $nama,
				'status_user' => 1,
				'runggun_id' => $asalgereja,
				'operator_id' => $asalgereja,
				'user_group_id' => 3,
				'status' => 1
			);
			// $checkFare = $this->model->checkOperatorCode($operatorcode, $operatorname);
			// if ($checkFare) {
			//     $this->_deleteImage($name);
			//     $response = json_encode(array(
			//         'code' => 101,
			//         'message' => $checkFare,
			//     ));
			// } else {
			$insert = $this->model->insert('tbl_user', $data);

			if ($insert) {
				$response =  json_api(1, 'Data Operator Berhasil Disimpan');
			} else {

				$this->_deleteImage($name);
				$response = json_encode($this->db->error());
			}

			$file = array('ADD', 'LANE', $this->_username, json_encode($data));

			$this->log_activity_txt->startLog($file, array('app.t_mtr_operator'));
		} else {
			$response = json_encode($this->upload->display_errors());
		}
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
	function editAnggota($ids)
    {

        validate_ajax();
        $id = $this->enc->decode($ids);
        $data['title'] = "Edit User Anggota";

        $data['gbkp'] = $this->model->getGbkp();
        $data['row'] = $this->model->getAnggota($id);
        $this->load->view('Anggota/edit', $data);
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
        $pekerjaan = $post['pekerjaan'];
        $alamat = $post['alamat'];
        $pendidikan = $post['pendidikan'];
        $domisili = $post['domisili'];
        $asalgereja = $this->enc->decode($post['gbkp']);
        $jk = $post['jk'];

        $username = $post['username'];
        $path = $_FILES['image']['name'];
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

        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $name = $nama . time() . '.' . $ext;
        $config['upload_path']          = './assets/img/fotoanggota/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $name;
        $config['overwrite']            = true;
        $config['max_size']             = 1024; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $cekerror = '';

        if (!is_dir('assets/img/fotoanggota/')) {
            mkdir('./assets/img/fotoanggota/', 0777, TRUE);
        }
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            $filename = $this->upload->data("file_name");
            try {
                $this->_deleteImage($this->input->post('logolama'));
            } catch (exception $e) {
                $cekerror = $e;
            }
        } else {
            $filename = $this->input->post('logolama');
            $cekerror = $this->upload->display_errors();
        }
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
            'foto' => $filename,
            'pendidikan' => $pekerjaan,
            'pekerjaan' => $pendidikan,
            'username' => $username,
            'asal_gereja' => $asalgereja,
            'updated_by' => $nama,
            'status_user' => 1,
        );

        if ($this->form_validation->run() == FALSE) {
            $response = json_api(0, validation_errors());
        } else {
            if ($cekerror === "<p>You did not select a file to upload.</p>" || empty($cekerror)) {

                $insert = $this->_model->delete($id, $data, 'tbl_user', 'id');

                if ($insert) {
                    $response =  json_api(1, 'Data Succesfull Saved');
                } else {

                    $response = json_encode($this->db->error());
                }
            } else {
                $response = json_api(101, $cekerror);
            }
        }


        echo $response;
    }
    public function deleteAnggota($id)
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
		$data['operator_id'] =$id;

		
		$file = array('DELETE', 'OPERATOR', $this->_username, json_encode($data));

		$this->log_activity_txt->startLog($file, array('app.t_mtr_operator'));
		echo $response;
	}
}
