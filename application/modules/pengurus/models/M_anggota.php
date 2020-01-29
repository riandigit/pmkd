<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_anggota extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
    }
    public function getDataOperator($runggun)
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

        $where = 'where id is not null and user_group_id = 3 and status_user = 1 and u.status = 1 ';
        if($runggun != 4){
            $where .=' and runggun_id = \'' .$runggun. '\'';
        }
		if (!empty($search['value'])) {

			$where .= '
					and (nama ilike \'%' . $search['value'] . '%\' or nik ilike \'%' . $search['value'] . '%\' 
					 )
				';
		}

		$sql =   '
		select u.*,g.nama as gereja , pe.nmpekerjaan, pen.nmpendidikan from tbl_user u left join tbl_gbkp g on u.runggun_id = g.id_seq left join pekerjaan pe on u.pekerjaan = pe.kdpekerjaan left join pendidikan pen on u.pendidikan = pen.kdpendidikan
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

			$slug = 'pengurus/anggota';
			$action = '';
			$delete = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'delete');
			$edit = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'edit');
			// $segment = $this->checkS($r['operator_code']);
			$checks = '';
			if ($delete) {
				// if ($segment == 'readonly') {
				// 	$checks = 'disabled';
				// }
				$urldelete = site_url('pengurus/anggota/deleteAnggota/') . '' . ($this->enc->encode($r['id']));
				$action .= '<button onClick="confirmationAction(\'Apakah Anda yakin menghapus data ini ?\', \'' . $urldelete . '\')" class="btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete" ' . $checks . '><i class="icon-trash"></i></button> ';
			}
			if ($edit) {
				$action .= '<button type="button" class="btn btn-info btn-icon btn-xs btn-dtgrid" title="Edit" onclick="showModal(\'' . site_url('pengurus/anggota/editAnggota/') . '' . ($this->enc->encode($r['id'])) . '\')" ><i class="icon-pencil"></i></button>';
			}
			if($r['jk'] ==1){
				$r['jk'] = 'Laki-laki';

			}else{
				$r['jk'] = 'Perempuan';

			}

			$r['no'] = $count;
			$count++;
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
	public function getAnggota($id){
        $qry = $this->db->query('SELECT * FROM tbl_user where id = \'' . $id . '\'')->row();
		return $qry;
	}
	public function getPekerjaan(){
        $qry = $this->db->query('SELECT kdpekerjaan as id_seq,nmpekerjaan as nama FROM pekerjaan')->result();
		return $qry;
	}
	public function getPendidikan(){
        $qry = $this->db->query('SELECT kdpendidikan as id_seq,nmpendidikan as nama FROM pendidikan')->result();
		return $qry;
	}
}