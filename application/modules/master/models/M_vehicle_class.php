<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_vehicle_class extends MY_Model{

	public function __construct() {
		parent::__construct();
        $this->_module = 'master/vehicle_class';
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
			0 =>'id_seq',
		);

		$order_column = $field[$order_column];

		$where = " WHERE status = 1";

		if ($customer != "") {
			$where .= " AND V.customer_id = $customer";
		}

		if(!empty($search['value']))
		{
			$where .=" AND (plate_number::varchar ilike '%".$search['value']."%' or stnk::varchar ilike '%".$search['value']."%'  OR REPLACE(plate_number, ' ', '') ilike '%".$search['value']."%' or owner_name ilike '%".$search['value']."%')";
		}

		$sql = "SELECT
					*
				FROM
					app.t_mtr_vehicle_class
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
			$id_enc = $this->enc->encode($row->id_seq);
			$row->number = $i;
			$row->status = "";

			$row->id_seq =$row->id_seq;
			$edit_url 	 = site_url($this->_module."/edit/{$id_enc}");
     		$delete_url  = site_url($this->_module."/action_delete/{$id_enc}");

     		$row->actions  = "";

     		$row->actions .= generate_button_new($this->_module, 'edit', $edit_url);

     		$check_vehicle = $this->db->query("SELECT vehicle_type FROM app.t_mtr_vehicle WHERE vehicle_status = 1 AND vehicle_type = '$row->vehicle_class_code'")->result();
     		if (!$check_vehicle) {
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

	public function check_data($table, $where="")
    {
        return $this->db->query("select * from $table $where")->row();
    }

    public function count_code($code)
	{
		return $this->db->query("SELECT COUNT(*) FROM app.t_mtr_vehicle_class WHERE vehicle_class_code ilike '$code%'")->row();exit;
	}

	public function get_edit($id)
	{
		return $this->db->query("SELECT
									* 
								FROM
									app.t_mtr_vehicle_class
								WHERE
									id_seq = $id")->row();
	}

	public function check_obu($obu_number, $id)
	{
		return $this->db->query("SELECT
									obu_number	
								FROM
									app.t_mtr_obu OBU
								WHERE
									OBU.obu_number = '$obu_number' AND obu_id != $id")->row();
	}

	public function get_class()
	{
		return $this->db->query("SELECT * FROM app.t_mtr_vehicle_class WHERE status = 1")->result();
	}

	public function get_customer()
	{
		return $this->db->query("SELECT * FROM app.t_mtr_customer WHERE customer_status = 1")->result();
	}

}