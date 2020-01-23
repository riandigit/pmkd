<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengurus_model extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->_module = 'configuration/Pengurus';
    }
    public function getDataPengurus()
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
			0 => 'name',
		);
		$order_column = $field[$order_column];

		$where = 'where id_seq is not null and status = 1 ';
		if (!empty($search['value'])) {

			$where .= '
					and (name ilike \'%' . $search['value'] . '%\')
				';
		}

		$sql =   '
		select id_seq,name from tbl_pengurus
		' . $where . ' ';
		$query = $this->db->query($sql);
		$records_total = $query->num_rows();
		$sql 		  .= " ORDER BY " . $order_column . " {$order_dir}";
		if ($length != -1) {
			$sql .= " LIMIT {$length} OFFSET {$start}";
		}
		$query = $this->db->query($sql);
		$grid = 'gridOperator';
		$status = 'pair';
        $data_rows = array();
        $count = 0;
		foreach ($query->result_array() as $r) {
            $count++;
			$slug = 'configuration/pengurus';
			$action = '';
			$delete = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'delete');
			$edit = $this->m_global->menuAccess($this->session->userdata('group_id'), $slug, 'edit');
			// $segment = $this->checkS($r['operator_code']);
			$checks = '';
			if ($delete) {
				// if ($segment == 'readonly') {
				// 	$checks = 'disabled';
				// }
				$urldelete = site_url('configuration/pengurus/deletePengurus/') . '' . ($this->enc->encode($r['id_seq'])) . '\',\'' . $grid . '\',\'' . $status;
				$action .= '<button onClick="confirmationAction(\'Apakah Anda yakin menghapus data ini ?\', \'' . $urldelete . '\')" class="btn btn-danger btn-icon btn-xs btn-dtgrid" title="Delete" ' . $checks . '><i class="icon-trash"></i></button> ';
			}
			if ($edit) {
				$action .= '<button type="button" class="btn btn-info btn-icon btn-xs btn-dtgrid" title="Edit" onclick="showModal(\'' . site_url('configuration/pengurus/editPengurus/') . '' . ($this->enc->encode($r['id_seq'])) . '\')" ><i class="icon-pencil"></i></button>';
			}
			
            $r['action'] = $action;
            $r['no'] = $count;
			$r['id_seq'] 	= '';
			$data_rows[] = $r;
		}
		return array(
			'draw'           => $draw,
			'recordsTotal'   => $records_total,
			'recordsFiltered' => $records_total,
			'data'           => $data_rows
		);
	}
}