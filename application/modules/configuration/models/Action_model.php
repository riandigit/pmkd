<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -------------------------
 * CLASS NAME : Groups_model
 * -------------------------
 *
 * @author     Robai <robai.rastim@gmail.com>
 * @copyright  2018
 *
 */

class Action_model extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->_module = 'configuration/action';
	}

    public function groupList(){
		$start        = $this->input->post('start');
		$length       = $this->input->post('length');
		$draw         = $this->input->post('draw');
		$search       = $this->input->post('search');
		$order        = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir    = strtoupper($order[0]['dir']);
		$field 		  = array(1 => 'action_name');
		$order_column = $field[$order_column];
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$where 		  = "WHERE status = 1";

		if (!empty($search['value'])){
			$where .= " AND (UPPER(action_name::VARCHAR) ILIKE '%".$iLike."%')";
		}

		$sql  		   = "SELECT id, action_name FROM tbl_action {$where}";
		$query         = $this->db->query($sql);
		$records_total = $query->num_rows();
		$sql 		  .=" ORDER BY ".$order_column." {$order_dir}";

		if($length != -1){
			$sql .=" LIMIT {$length} OFFSET {$start}";			
		}

		$query     = $this->db->query($sql);
		$rows_data = $query->result();

		$rows = array();
		$i    = ($start + 1);

		foreach ($rows_data as $row) {
			$row->number= $i;
			$row->action_name = strtoupper($row->action_name);
			$row->id 	= $this->enc->encode($row->id);
     		$edit_url 	= site_url($this->_module."/edit/{$row->id}");
     		$delete_url = site_url($this->_module."/action_delete/{$row->id}");
     		$check 		= $this->global_model->checkData('tbl_menu_detail',array('action_id' => $this->enc->decode($row->id)));

     		$row->actions = generate_button_new($this->_module, 'edit', $edit_url);
        	if(!$check){
        		$row->actions .= generate_button_new($this->_module, 'delete', $delete_url);
        	}

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
}
