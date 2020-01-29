<?php

class Home_model extends CI_Model {

	function get_profile()
	{
		$id = $this->session->userdata('id');
		
		return $this->db->query("SELECT
			UG.NAME AS group_name,
			UU.nama as full_name,g.nama as gereja,UU.nik as ktp,
			UU.* 
			FROM
			tbl_user UU
			LEFT JOIN tbl_user_group UG ON UU.user_group_id = UG.ID left join tbl_gbkp g on UU.runggun_id = g.id_seq 
			WHERE
			UU.ID = $id");
	}
	
	public function select_data($table, $where)
	{
		return $this->db->query("select * from $table $where");
	}

	public function insert_data($table,$data)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function delete_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->delete($table, $data);
	}
	public function getDataWaiting($runggun)
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


        $where = 'where id is not null and user_group_id = 3 and status_user =2 ';
       
		if (!empty($search['value'])) {

			$where .= '
					and (nama ilike \'%' . $search['value'] . '%\' or nik ilike \'%' . $search['value'] . '%\' 
					 )
				';
		}

		if($runggun != 4){
			$where .='and u.runggun_id = '.$runggun;
		}

		$sql =   '
		select u.*,g.nama as runggun from tbl_user u left join tbl_gbkp g on u.runggun_id = g.id_seq
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
			$checks = '';
			if ($delete) {
				
				$urldelete = site_url('home/home/permitForm/') . '' . ($this->enc->encode($r['id']));
				$action .= '<button onClick="showModal(\'' . $urldelete. '\')" class="btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete" ' . $checks . '><i class="fa fa-exchange"></i></button> ';
			}
			

			// $cek = PUBPATH . "assets/img/fotoanggota/" . $r['foto'];
			// $logo = base_url('assets/img/fotoanggota/') . $r['foto'];
			// if (!file_exists($cek)) {

			// 	$logo = base_url('assets/img/noimage.png');
			// }
			if($r['jk'] ==1){
				$r['jk'] = 'Laki-laki';

			}else{
				$r['jk'] = 'Perempuan';

			}
			if($r['runggun_id'] ==0){
				$r['asal_gereja'] = $r['asal_gereja'];

			}else{
				$r['asal_gereja'] = $r['runggun'];

			}

			$r['no'] = $count;
			$count++;
			// $image = '<img  width="200" height="121" src="' . $logo . '" alt="">';
			// $image = $tumbnail;
			// $r['foto'] = $image;
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
	public function getWaiting($runggun)
	{

		
        $where = 'where id is not null and user_group_id = 3 and status_user =2 ';


		if($runggun != 0){
			$where .='and u.runggun_id = '.$runggun;
		}

		$sql =   '
		select u.*,g.nama as runggun from tbl_user u left join tbl_gbkp g on u.runggun_id = g.id_seq
		' . $where . ' ';
		$query = $this->db->query($sql);
		
		return $query->num_rows();
	}
}