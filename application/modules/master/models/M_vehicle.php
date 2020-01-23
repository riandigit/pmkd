<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_vehicle extends MY_Model{

	public function __construct() {
		parent::__construct();
        $this->_module = 'master/vehicle';
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
			0 =>'vehicle_id',
		);

		$order_column = $field[$order_column];

		$where = " WHERE V.vehicle_status = 1";

		if ($customer != "") {
			$where .= " AND V.customer_id = $customer";
		}

		if(!empty($search['value']))
		{
			$where .=" AND (plate_number::varchar ilike '%".$search['value']."%' or stnk::varchar ilike '%".$search['value']."%'  OR REPLACE(plate_number, ' ', '') ilike '%".$search['value']."%' or owner_name ilike '%".$search['value']."%')";
		}

		$sql = "SELECT
					CC.first_name,
					CC.last_name,
					VC.vehicle_class_name,
					V.* 
				FROM
					app.t_mtr_vehicle V
					JOIN app.t_mtr_customer CC ON CC.customer_id = V.customer_id
					LEFT JOIN app.t_mtr_vehicle_class VC ON V.vehicle_type = VC.vehicle_class_code
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
			$id_enc = $this->enc->encode($row->vehicle_id);
			$row->customer_name = $row->first_name . " " . $row->last_name;
			$row->number = $i;
			$row->status = "";

			$row->vehicle_id =$row->vehicle_id;
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

	public function check_data($table, $where="")
    {
        return $this->db->query("select * from $table $where")->row();
    }

	public function get_edit($id)
	{
		return $this->db->query("SELECT
									CC.first_name,
									CC.last_name,
									VC.vehicle_class_name,
									V.* 
								FROM
									app.t_mtr_vehicle V
									JOIN app.t_mtr_customer CC ON CC.customer_id = V.customer_id
									LEFT JOIN app.t_mtr_vehicle_class VC ON V.vehicle_type = VC.vehicle_class_code
								WHERE
									V.vehicle_id = $id")->row();
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