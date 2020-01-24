<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Menu_model extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->_module = 'configuration/menu';
	}

	function get_list() {
		$result = array();
		$items  = array();

		$sql 	= "SELECT id, name, m.order, icon, slug
				   FROM tbl_menu_web m
				   WHERE (parent_id IS NULL OR parent_id = 0) AND status = 1 
				   ORDER BY m.order ASC";
		$query 	= $this->db->query($sql)->result();

		$status    = '<span class="label bg-green">status</span>';
        $nonstatus = '<span class="label bg-red">Not status</span>';
		
		if($query){
			foreach ($query as $row){
				$has_child 	  = $this->check_parent($row->id);
				$row->iconCls = 'fa fa-'.$row->icon;
				$id 	   	  = $this->enc->encode($row->id);
	     		$edit_url     = site_url($this->_module."/edit/{$id}");
	     		$delete_url   = site_url($this->_module."/action_delete/{$id}");
	     		$checkPrivilege = $this->global_model->checkData('tbl_privilege', array('menu_id' => $row->id));

	            if($has_child){
					// $row->state = 'closed';
					$row->children = $this->get_list_children($row->id);
				}

				$row->action = generate_button_new($this->_module, 'edit', $edit_url);
	            if(strtolower($row->slug) != $this->_module && strtolower($row->slug) != 'privilege'){
	            	if(!$checkPrivilege){
		            	$row->action .= generate_button($this->_module, 'delete', '<button class="btn btn-sm btn-danger" title="Hapus" onclick="delete_menu(\'Apakah Anda yakin menghapus data ini ?\', \''.$delete_url.'\')" title="Hapus"> <i class="fa fa-trash-o"></i> </button> ');
		            }
	            }
					
				array_push($items, $row);
			}
		}
		
		$result["rows"] = $items;
		
		return $result;
	}

	function get_list_children($pi) {
		$items  = array();

		$sql 	= "SELECT id, name, m.order, icon, slug
				   FROM tbl_menu_web m
				   WHERE parent_id = $pi AND status = 1 
				   ORDER BY m.order ASC";
		$query 	= $this->db->query($sql)->result();

		$status    = '<span class="label bg-green">status</span>';
        $nonstatus = '<span class="label bg-red">Not status</span>';
		
		if($query){
			foreach ($query as $row){
				$has_child 	  = $this->check_parent($row->id);
				$row->iconCls = 'fa fa-angle-double-right';
				$id 	   	  = $this->enc->encode($row->id);
	     		$edit_url     = site_url("configuration/menu/edit/{$id}");
	     		$delete_url   = site_url("configuration/menu/action_delete/{$id}");
				$checkPrivilege = $this->global_model->checkData('tbl_privilege', array('menu_id' => $row->id));

	            if($has_child){
					// $row->state = 'closed';
					$row->children = $this->get_list_children($row->id);
				}

				$row->action = generate_button_new($this->_module, 'edit', $edit_url);
	            if(strtolower($row->slug) != $this->_module && strtolower($row->slug) != 'privilege'){
	            	if(!$checkPrivilege){
		            	$row->action .= generate_button($this->_module, 'delete', '<button class="btn btn-sm btn-danger" title="Hapus" onclick="delete_menu(\'Apakah Anda yakin menghapus data ini ?\', \''.$delete_url.'\')" title="Hapus"> <i class="fa fa-trash-o"></i> </button> ');
		            }
	            }
					
				array_push($items, $row);
			}
		}
		
		return $items;
	}

	function check_parent($id){
		$sql   = "SELECT * FROM tbl_menu_web WHERE parent_id = $id";
		$query = $this->db->query($sql);
		$row   = $query->num_rows();

		return $row > 0 ? true : false;
	}

	function checkOrder($parent,$order,$id=''){
		if($parent == 0){
			$where = "(parent_id IS NULL OR parent_id = 0)";
		}else{
			$where = "parent_id = {$parent}";
		}

		if($id != ''){
			$where2 = "AND id != {$id}";
		}else{
			$where2 = '';
		}

		$sql = "SELECT * FROM tbl_menu_web m
				WHERE {$where} AND m.order = $order AND status = 1 {$where2}";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function select_menu_detail($menuid){
        $data= array();
		$sql = "SELECT id, action_id
				FROM tbl_menu_detail 
				WHERE status = 1 AND menu_id = $menuid 
				ORDER BY action_id ASC";

		$result = $this->db->query($sql)->result();

		if($result){
            foreach ($result as $row) {
                $data[$row->id] = $row->action_id;
            }
        }

        return $data;
	}

	function select_menu_privilege($menuid,$menudetail){
		$this->db->where('menu_id', $menuid);
		$this->db->where_in('menu_detail_id', $menudetail);
		return $this->db->get('tbl_privilege')->result();
	}

	function deletePrivilege($menuid,$menudetail){
		$this->db->where('menu_id', $menuid);
		$this->db->where_in('menu_detail_id', $menudetail);
		$this->db->delete('tbl_privilege');
	    return $this->db->affected_rows();
	}
}