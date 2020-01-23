<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->_module = 'configuration/users';
	}

	public function userList(){
		$start        = $this->input->post('start');
		$length       = $this->input->post('length');
		$draw         = $this->input->post('draw');
		$search       = $this->input->post('search');
		$order        = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir    = strtoupper($order[0]['dir']);
		$user_group_id=$this->enc->decode($this->input->post('user_group'));
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0=>'id',
			1 => 'first_name',
			2 => 'last_name',
			3 => 'username',
			4 => 'email',
			5 => 'group_name',
			6 => 'operator_name'
		);

		$order_column = $field[$order_column];

		$where = "WHERE UU.status IN (1, -1) ";

		if(!empty($user_group_id))
		{
			$where .=" AND UU.user_group_id='".$user_group_id."'";
		}

		if (!empty($search['value'])){
			$where .= " AND (UPPER(first_name::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(last_name::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(username::VARCHAR) ILIKE '%".$iLike."%')";
		}

		$sql = "SELECT
					DISTINCT(UU.*),
					UG.NAME AS group_name,
					OO.operator_name,
					MM.merchant_name
				FROM
					tbl_user UU
					JOIN tbl_user_group UG ON UG.id = UU.user_group_id
					LEFT JOIN app.t_mtr_operator OO ON OO.operator_id::varchar = UU.operator_cs_id
					LEFT JOIN app.t_mtr_merchant MM ON MM.merchant_code = UU.operator_cs_id
				{$where}";

		$query         = $this->db->query($sql);
		$records_total = $query->num_rows();
		$sql 		  .= " ORDER BY ".$order_column." {$order_dir}";

		if($length != -1){
			$sql .=" LIMIT {$length} OFFSET {$start}";			
		}

		$query     = $this->db->query($sql);
		$rows_data = $query->result();
		$rows 	   = array();
		$i 		   = ($start + 1);

		foreach ($rows_data as $row) {
			$row->number= $i;
			$row->id 	= $this->enc->encode($row->id);
     		$edit_url 	= site_url($this->_module."/edit/{$row->id}");
     		$delete_url = site_url($this->_module."/action_delete/{$row->id}");
     		$reset_url 	= site_url($this->_module."/reset_password/{$row->id}");


		    $nonaktif    = site_url($this->_module."/disable/".$this->enc->encode($row->id.'|-1'));
		    $aktif       = site_url($this->_module."/enable/".$this->enc->encode($row->id.'|1'));

     		$row->actions  ="";
     		// $row->actions .= generate_button_new($this->_module, 'delete', $delete_url);

     		if ($row->user_group_id == 5) {
     			$row->operator_name = $row->merchant_name;
     		}

     		if($row->status == 1)
     		{
	        	$row->status   = success_label('Aktif');
	        	$row->actions  .= generate_button_new($this->_module, 'edit', $edit_url);
	        	$row->actions .= generate_button($this->_module, 'edit', '<button class="btn btn-sm btn-danger" onclick="confirmationAction(\'Apakah Anda yakin akan menonaktifkan data ini ?\', \''.$nonaktif.'\')" title="Nonaktifkan"> <i class="fa fa-ban"></i> </button> ');
	      	}else{
	        	$row->status   = failed_label('Tidak Aktif');
	        	$row->actions .= generate_button($this->_module, 'edit', '<button class="btn btn-sm btn-primary" onclick="confirmationAction(\'Apakah Anda yakin mengaktifkan data ini ?\', \''.$aktif.'\')" title="Nonaktifkan"> <i class="fa fa-check"></i> </button> ');
	      	}

     		$row->actions .= generate_button($this->_module, 'edit', '<button class="btn btn-sm btn-warning" title="Ganti Password" onclick="showModal(\''.$reset_url.'\')"> <i class="fa fa-lock"></i></button>');
     		
			$rows[] = $row;
			unset($row->id);
			$i++;
		}

		return array(
			'draw'           => $draw,
			'recordsTotal'   => $records_total,
			'recordsFiltered'=> $records_total,
			'data'           => $rows
		);
	}

	public function update_data($table,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function dropdown_op()
	{
		$sql = "SELECT
					operator_id::varchar AS operator_cs_id,
					operator_name AS operator_cs_name
				FROM
					app.t_mtr_operator
				WHERE
					operator_status = 1
					
				UNION ALL

				SELECT
					merchant_code AS operator_cs_id,
					merchant_name AS operator_cs_name
				FROM
					app.t_mtr_merchant
				WHERE
					status = 1";

		return $this->db->query($sql)->result();
	}

	public function download()
	{
		return $this->db->query("select p.name as port_name, u.*, ug.name AS group_name 
		FROM tbl_user u LEFT JOIN tbl_user_group ug ON ug.id = u.user_group_id 
		LEFT JOIN app.t_mtr_port p on u.port_id=p.id 
		where u.status not in (-5)
		order by ug.name asc
		");
	}

	public function download_excel(){


		$user_group=$this->enc->decode($this->input->get("user_group"));

        $search=$this->input->get("search");
        $iLike        = trim(strtoupper($this->db->escape_like_str($search)));



		$where = "WHERE u.status not in (-5)  ";

		if(!empty($user_group))
		{
			$where .="and (u.user_group_id='".$user_group."')";
		}

		if (!empty($search['value'])){
			$where .= " AND (UPPER(first_name::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(last_name::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(username::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(ug.name::VARCHAR) ILIKE '%".$iLike."%'";
			$where .= " OR UPPER(p.name::VARCHAR) ILIKE '%".$iLike."%')";
		}

		$sql = "SELECT p.name as port_name, u.*, ug.name AS group_name 
				FROM tbl_user u
				LEFT JOIN tbl_user_group ug ON ug.id = u.user_group_id 
				LEFT JOIN app.t_mtr_port p on u.port_id=p.id 
				{$where}
				order by u.first_name asc
				";

		$query     = $this->db->query($sql);

		$rows=array();
		foreach ($query->result() as $row) {

     		if($row->status == 1)
     		{
	        	$row->status   = 'Aktif';
	      	}
	      	else
	      	{
	        	$row->status   ='Tidak Aktif';
	      	}

	      	$rows[]=$row;

		}

		return $rows;
	}


}
