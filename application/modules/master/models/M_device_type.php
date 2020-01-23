<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_device_type extends MY_Model{

	public function __construct() {
		parent::__construct();
        $this->_module = 'master/device_type';
	}

    public function dataList(){
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$search = $this->input->post('search');

		$customer = $this->enc->decode($this->input->post('customer'));

		$order = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir = strtoupper($order[0]['dir']);
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0 =>'id',
		);

		$order_column = $field[$order_column];

		$where = " WHERE status = 1";

		if(!empty($search['value']))
		{
			$where .=" AND (name::varchar ilike '%".$search['value']."%')";
		}

		$sql = "SELECT
					*
				FROM
					app.t_mtr_device_type
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

			$check_device = $this->db->query("SELECT device_type_id FROM app.t_mtr_device WHERE status = 1 AND device_type_id = '$row->id'")->result();

			$edit_url 	 = site_url($this->_module."/edit/{$id_enc}");
     		$delete_url  = site_url($this->_module."/action_delete/{$id_enc}");

     		$row->actions  = "";

     		$row->actions .= generate_button_new($this->_module, 'edit', $edit_url);
     		if (!$check_device) {
				$row->actions .= generate_button_new($this->_module, 'delete', $delete_url);
			}

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

	public function get_edit($id)
	{
		return $this->db->query("SELECT * FROM app.t_mtr_device_type WHERE id = $id")->row();
	}

}