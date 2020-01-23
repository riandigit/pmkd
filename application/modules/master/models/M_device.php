<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_device extends MY_Model{

	public function __construct() {
		parent::__construct();
        $this->_module = 'master/device';

        $this->group_session = $this->session->userdata('group_id');
		$this->operator_cs_id = $this->enc->decode($this->session->userdata('operator_cs_id'));
	}

    public function dataList(){
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$search = $this->input->post('search');

		$device_type = $this->enc->decode($this->input->post('device_type'));

		$order = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir = strtoupper($order[0]['dir']);
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0 =>'id',
		);

		$order_column = $field[$order_column];

		$where = " WHERE DD.status = 1";

		if ($this->group_session == 4) {
			$where .= " AND DD.operator_id = $this->operator_cs_id";
		}

		if (!empty($device_type)) {
			$where .= " AND DD.device_type_id = $device_type";
		}

		if(!empty($search['value']))
		{
			$where .=" AND (device_name::varchar ilike '%".$search['value']."%')";
		}

		$sql = "SELECT
					DT.name as device_type,
					LL.name AS lane_name,
					PP.plaza_name,
					OO.operator_name,
					DD.* 
				FROM
					app.t_mtr_device DD
					JOIN app.t_mtr_device_type DT ON DT.id = DD.device_type_id
					JOIN app.t_mtr_lane LL ON LL.id_seq = DD.lane_id
					JOIN app.t_mtr_plaza PP ON PP.plaza_code = LL.plaza_code
					JOIN app.t_mtr_operator OO ON OO.operator_id = DD.operator_id
				$where";

		$query         = $this->db->query($sql);
		$records_total = $query->num_rows();
		$sql 		  .= " ORDER BY ".$order_column." {$order_dir}";

		if($length != -1){
			$sql .=" LIMIT {$length} OFFSET {$start}";
		}

		$query     = $this->db->query($sql);
		$rows_data = $query->result();

		$rows 	= array();
		$i  	= ($start + 1);

		foreach ($rows_data as $row) {
			$id_enc = $this->enc->encode($row->id);
			$row->number = $i;
			$row->status = "";

			$edit_url 	 = site_url($this->_module."/edit/{$id_enc}");
     		$delete_url  = site_url($this->_module."/action_delete/{$id_enc}");

     		$row->actions  = "";

     		$row->actions .= generate_button_new($this->_module, 'edit', $edit_url);
     		$row->actions .= generate_button_new($this->_module, 'delete', $delete_url);

     		$row->no = $i;

			$rows[] = $row;
			$i++;
		}

		return array(
			'draw'           => $draw,
			'recordsTotal'   => $records_total,
			'recordsFiltered'=> $records_total,
			'data'           => $rows
		);
	}

	public function dropdown_lane()
	{
		return $this->db->query("SELECT
									LL.id_seq,
									LL.name AS lane_name,
									PP.plaza_name
								FROM
									app.t_mtr_lane LL
									JOIN app.t_mtr_plaza PP ON PP.plaza_code = LL.plaza_code
								WHERE LL.status = 1")->result();
	}

	public function get_edit($id)
	{
		return $this->db->query("SELECT * FROM app.t_mtr_device WHERE id = $id")->row();
	}

}