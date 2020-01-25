<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_runggun extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
    }
    public function getDataRunggun()
	{

		$data = array();
		$start        = $this->input->post('start');
		$length       = $this->input->post('length');
		$draw         = $this->input->post('draw');
		$search       = $this->input->post('search');
		$order        = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir    = strtoupper($order[0]['dir']);
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0 => 'nik',
			1  => 'nama',
		);
		$order_column = $field[$order_column];

        $where = 'where id is not null and user_group_id = 2 and status_user =1 and status = 1';
       
		if (!empty($search['value'])) {

			$where .= '
					and (nama ilike \'%' . $search['value'] . '%\' or nik ilike \'%' . $search['value'] . '%\' 
					 )
				';
		}

		$sql =   '
		select * from tbl_user  
		' . $where . ' ';
		$query = $this->db->query($sql);
		$records_total = $query->num_rows();
		$sql 		  .= " ORDER BY " . $order_column . " {$order_dir}";
		if ($length != -1) {
			$sql .= " LIMIT {$length} OFFSET {$start}";
		}
		$query = $this->db->query($sql);
		$count = 1;
		$data_rows = array();
		foreach ($query->result_array() as $r) {

			$slug = 'pengurus/runggun';
			$action = '';
			$delete = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'delete');
			$edit = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'edit');
			// $segment = $this->checkS($r['operator_code']);
			$checks = '';
			if ($delete) {
				// if ($segment == 'readonly') {
				// 	$checks = 'disabled';
				// }
				$urldelete = site_url('pengurus/runggun/deleteRunggun/') . '' . ($this->enc->encode($r['id']));
				$action .= '<button onClick="confirmationAction(\'Apakah Anda yakin menghapus data ini ?\', \'' . $urldelete . '\')" class="btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete" ' . $checks . '><i class="icon-trash"></i></button> ';
			}
			if ($edit) {
				$action .= '<button type="button" class="btn btn-info btn-icon btn-xs btn-dtgrid" title="Edit" onclick="showModal(\'' . site_url('pengurus/runggun/editRunggun/') . '' . ($this->enc->encode($r['id'])) . '\')" ><i class="icon-pencil"></i></button>';
			}

			$cek = PUBPATH . "assets/img/fotoanggota/" . $r['foto'];
			$logo = base_url('assets/img/fotoanggota/') . $r['foto'];
			if (!file_exists($cek)) {

				$logo = base_url('assets/img/noimage.png');
			}
			if($r['jk'] ==1){
				$r['jk'] = 'Laki-laki';

			}else{
				$r['jk'] = 'Perempuan';

			}

			$r['no'] = $count;
			$count++;
			$image = '<img  width="200" height="121" src="' . $logo . '" alt="">';
			// $image = $tumbnail;
			$r['foto'] = $image;
			$r['action'] = $action;
			$r['id'] 	= '';
			$data_rows[] = $r;
		}
		return array(
			'draw'           => $draw,
			'recordsTotal'   => $records_total,
			'recordsFiltered' => $records_total,
			'data'           => $data_rows
		);
    }
    public function getGbkp(){
        $qry = $this->db->query('SELECT id_seq,nama FROM tbl_gbkp where status = 1')->result();
		return $qry;
    }
    public function insert($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
    }
    public function getRungguns($id){
        $qry = $this->db->query('SELECT * FROM tbl_user where id = \'' . $id . '\'')->row();
		return $qry;
    }
}