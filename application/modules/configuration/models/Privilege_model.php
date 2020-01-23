<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privilege_model extends CI_Model
{
	function get_list()
	{
		$result = array();
		$items  = array();
		$group  = $this->input->post('group');

		$sql 	= "SELECT id, name, m.order, icon, slug, parent_id
				   FROM tbl_menu_web m
				   WHERE (parent_id IS NULL OR parent_id = 0) AND status = 1 
				   ORDER BY m.order ASC";
		$query 	= $this->db->query($sql)->result();

		if ($query) {
			foreach ($query as $row) {
				$has_child 	  = $this->check_parent($row->id);
				$row->iconCls = 'fa fa-' . $row->icon;
				$row->menu_id = '<label style="padding-top: 7px;"><input type="checkbox" class="act menu" value="' . $row->id . '"></label>';
				$row->action  = $this->select_menu_detail($row->id, $row->parent_id, $group);

				if ($has_child) {
					// $row->state = 'closed';
					$row->children = $this->get_list_children($row->id, $row->id);
				}

				array_push($items, $row);
			}
		}

		$result['rows'] = $items;
		// $result['privilege'] = $this->global_model->selectById('core.t_mtr_privilege', 'group_id', $group);

		return $result;
	}

	function get_list_children($pi)
	{
		$items  = array();
		$group  = $this->input->post('group');

		$sql 	= "SELECT id, name, m.order, icon, slug, parent_id
				   FROM tbl_menu_web m
				   WHERE parent_id = $pi AND status = 1 
				   ORDER BY m.order ASC";
		$query 	= $this->db->query($sql)->result();

		if ($query) {
			foreach ($query as $row) {
				$has_child 	  = $this->check_parent($row->id);
				$row->iconCls = 'fa fa-angle-double-right';

				$row->menu_id = '<label style="padding-top: 7px;"><input type="checkbox" class="act menu" value="' . $row->id . '"></label>';
				$row->action  = $this->select_menu_detail($row->id, $row->parent_id, $group);

				if ($has_child) {
					// $row->state = 'closed';
					$row->children = $this->get_list_children($row->id);
				}

				array_push($items, $row);
			}
		}

		return $items;
	}

	function check_parent($id)
	{
		$sql   = "SELECT * FROM tbl_menu_web WHERE parent_id = $id";
		$query = $this->db->query($sql);
		$row   = $query->num_rows();

		return $row > 0 ? true : false;
	}

	function select_action($menu_id, $group_id)
	{
		$sql = "SELECT view, add, edit, delete, detail, approval FROM core.t_mtr_privilege_detail pd
				JOIN tbl_privilege p ON p.id = pd.privilege_id AND p.group_id = $group_id
				WHERE menu_id = $menu_id";
		return $this->db->query($sql)->result();
	}

	function privilege_detail($privilege_id)
	{
		$sql = "SELECT id, menu_id FROM core.t_mtr_privilege_detail WHERE privilege_id  = $privilege_id";
		return $this->db->query($sql)->result();
	}

	function privilege_detail_by_group($group_id)
	{
		$sql = "SELECT pd.id FROM core.t_mtr_privilege_detail pd
				JOIN core.t_mtr_privilege p ON p.id = pd.privilege_id WHERE p.group_id = $group_id";
		return $this->db->query($sql)->result();
	}

	function privilege_web_by_group($group_id)
	{
		$sql = "SELECT id FROM tbl_privilege pd WHERE user_group_id = $group_id";
		return $this->db->query($sql)->result();
	}

	function checkBox($val, $name, $id)
	{
		$checked = '';
		if ($val == 't') {
			$checked = 'checked';
		}
		$html = '<label style="padding-top: 7px;">';
		$html .= '<input ' . $checked . ' type="checkbox" class="act act_' . $id . '" name="action[' . $name . '_' . $id . ']" value="' . $id . '"></label>';
		$html .= '<label>';

		return $html;
	}

	function select_menu_detail($menuid, $pi, $group)
	{
		$data = array();
		$sql = "SELECT bb.name, bb.id AS menu_id, aa.id AS detail_id, dd.id AS action_id,  dd.action_name, cc.id AS privilege_id, cc.user_group_id AS user_group_id, cc.status
				FROM tbl_menu_detail aa
				LEFT JOIN tbl_menu_web bb ON aa.menu_id = bb.id AND bb.status = 1 AND bb.id = $menuid
				LEFT JOIN tbl_privilege cc ON aa.id = cc.menu_detail_id AND cc.user_group_id = $group
				LEFT JOIN tbl_action dd ON dd.id = aa.action_id AND dd.status = 1
				WHERE aa.status = 1 AND bb.parent_id = $pi
				ORDER BY dd.id ASC";
		// die($sql);
		$html = "<div class='form-group' style='margin: auto;'>";
		$result = $this->db->query($sql)->result();

		if ($result) {
			foreach ($result as $row) {
				$checked   = '';
				$privilege = $row->privilege_id;

				if ($row->privilege_id == null || $row->privilege_id == '') {
					$privilege  = 0;
				}

				if ($row->status == 1) {
					$checked  = 'checked';
				}

				$action_name = strtoupper($row->action_name);

				$html .= "<label style='padding-top: 7px;'><input type='checkbox' data-menu_id='{$row->menu_id}' data-detail_id='{$row->detail_id}' data-privilege='{$privilege}' data-status='{$row->status}' class='actions act act_{$row->menu_id}' {$checked}> {$action_name}</label> ";
				$data[] = $html;
			}
		}

		$html .= "</div>";

		return $html;
	}
}
