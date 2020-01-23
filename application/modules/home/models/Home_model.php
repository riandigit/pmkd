<?php

class Home_model extends CI_Model {

	function get_profile()
	{
		$id = $this->session->userdata('id');
		
		return $this->db->query("SELECT
			UG.NAME AS group_name,
			concat ( UU.first_name, ' ', UU.last_name ) AS full_name,
			UU.* 
			FROM
			core.t_mtr_user UU
			LEFT JOIN core.t_mtr_user_group UG ON UU.user_group_id = UG.ID 
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
}