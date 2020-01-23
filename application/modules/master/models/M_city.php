<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_city extends MY_Model{

	public function __construct() {
		parent::__construct();
        $this->_module = 'master/city';
    }
    public function dataListcity(){
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$search = $this->input->post('search');

		$order = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir = strtoupper($order[0]['dir']);
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0 =>'id_seq',
		);

		$order_column = $field[$order_column];

		$where = " WHERE status = 1";
        if (!empty($search['value'])) {

			$where .= '
					and (name ilike \'%' . $search['value'] . '%\' 
					 )
				';
		}

		$sql = "SELECT
					id_seq , name
				FROM
					app.t_mtr_city
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

			$edit_url 	 = site_url($this->_module."/edit/{$id_enc}");
     		$delete_url  = site_url($this->_module."/action_delete/{$id_enc}");

     		$row->actions  = "";

     		$row->actions .= generate_button_new($this->_module, 'edit', $edit_url);
     		$row->actions .= generate_button_new($this->_module, 'delete', $delete_url);

     		$row->no = $i;
             $row->id_seq = '';

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
		return $this->db->query("SELECT c.id_seq,c.id_province,p.id_seq as id_island ,c.name FROM app.t_mtr_city c left join mhi.t_mtr_province p on c.id_province = p.id_seq WHERE c.id_seq = $id")->row();
	}
    public function getProvince(){
        $qry = $this->db->query('select * from app.t_mtr_province')->result();
		return $qry;
    }
    
}