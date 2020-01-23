<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	/*
	* @params tabel, column
	* $return last_id
	*/
	public function delete($id, $data, $table,$status=null)
	{$where ='id_seq';
		if($status != null){
			$where = $status;
		}
		// var_dump($where);
		$this->db->where($where, $id);
		return $this->db->update($table, $data);
	}
	/*
	* @params tabel, column
	* $return last_id
	*/
	
	public function getLastID($tabel, $select, $idseq=null)
	{
		$id_Seq = 'id_seq';
		if($idseq){
			$id_Seq=$idseq;
		}
		$sql = 'select max('.$id_Seq.') from  ' . $tabel . ' ';
		$id = $this->db->query($sql)->row();

		if (!empty($id->max)) {
			$sql2 = 'select ' . $select . ' from ' . $tabel . ' where '.$id_Seq.' = ' . $id->max . '';
			$return = $this->db->query($sql2)->row();
		} else {
			$return = '';
		}
		return $return;
	}
	/*
	* @params idterakhir, panjangkode, panjangangka
	*
	* @return id
	*/
	public function autoIncrement($id_terakhir, $panjang_kode, $panjang_angka){
		$kode = substr($id_terakhir, 0, $panjang_kode);
		$angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
		$angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
		$id_baru = $kode.$angka_baru;
		return $id_baru;
	}
	public function getMenu($user_group_id)
	{
		// $query = $this->db->query("SELECT M.id,M.parent_id,M.name,M.slug,M.icon FROM t_mtr_privilege P
		// 	JOIN t_mtr_menu M ON M.id = P.menu_id AND P.status = 1
		// 	JOIN t_mtr_menu_detail MD ON MD.menu_id = M.id
		// 	JOIN t_mtr_user U ON U.user_group_id = P.user_group_id
		// 	JOIN t_mtr_menu_action MA ON MA.id = MD.action_id AND MA.name = 'view'
		// 	WHERE U.user_group_id = $user_group_id");
		$query = $this->db->query("SELECT DISTINCT(M.id),P.menu_id,M.parent_id,M.name,M.slug,M.icon,M.order FROM core.t_mtr_privilege_web P
			JOIN tbl_menu_web M ON M.id = P.menu_id AND P.status = 1 AND M.status = 1
			JOIN tbl_menu_detail MD ON MD.menu_id = M.id AND MD.status = 1
			JOIN tbl_user U ON U.user_group_id = P.user_group_id
			JOIN tbl_action MA ON MA.id = MD.action_id AND MA.action_name = 'view'
			WHERE U.user_group_id = $user_group_id ORDER BY M.order");
		
		$data = array();

		foreach ($query->result() as $key => $value) {
			$value->action = $this->menuAction($user_group_id,$value->id);
			$data[$value->parent_id][]=$value; 
		}
		

		return $data;

		// return $query->result();
	}

	public function menuAction($user_group_id,$menu_id)
	{
		$data = array();
		$query = $this->db->query("SELECT DISTINCT(MA.id),M.order, MA.action_name AS action FROM tbl_privilege P JOIN tbl_menu_web M ON M.id = P.menu_id AND P.status = 1 AND M.status = 1 AND M.id = $menu_id JOIN tbl_menu_detail MD ON MD.menu_id = M.id AND MD.status = 1 JOIN tbl_user U ON U.user_group_id = P.user_group_id JOIN tbl_menu_action MA ON MA.id = MD.action_id WHERE U.user_group_id = $user_group_id ORDER BY M.order ASC");

		foreach ($query->result() as $key => $value) {
			$data[] = $value->action;
		}

		return $data;
	}
	public function getIsland(){
	
			$qry = $this->db->query('SELECT id_seq,name FROM app.t_mtr_island where status = 1')->result();
		
		return $qry;
	}

	public function getProvince($islandid=null){
		if($islandid != null){

			$qry = $this->db->query('SELECT id_seq,name FROM app.t_mtr_province where id_island=' . $islandid)->result();
		} else {
			$qry = $this->db->query('SELECT id_seq,name FROM app.t_mtr_province')->result();
		}
		
		return $qry;
	}
	public function getcity($provinceid=null){
		if($provinceid != null){

			$qry = $this->db->query('SELECT id_seq,name FROM app.t_mtr_city where id_province=' . $provinceid)->result();
		} else {
			$qry = $this->db->query('SELECT id_seq,name FROM app.t_mtr_city')->result();
		}
		
		return $qry;
	}
	public function menuAccess($user_group_id,$slug,$action)
	{
		// $query = $this->db->query("SELECT DISTINCT(M.id),P.menu_id,M.parent_id,M.name,M.slug,M.icon,M.order,P.status FROM t_mtr_privilege P
		// 	LEFT JOIN t_mtr_menu M ON M.id = P.menu_id AND P.status = 1 AND M.status = 1  AND M.slug = '$slug' JOIN t_mtr_menu_detail MD ON MD.menu_id = M.id AND MD.status = 1 AND P.status =1 JOIN t_mtr_user U ON U.user_group_id = P.user_group_id JOIN t_mtr_menu_action MA ON MA.id = MD.action_id AND MA.name = '$action' WHERE U.user_group_id = $user_group_id AND P.status=1 ORDER BY M.order ASC");
		$query = $this->db->query("SELECT DISTINCT
			( M.ID ),
			P.menu_id,
			M.parent_id,
			M.name,
			M.slug,
			M.icon,
			M.ORDER,
			P.status
			FROM
			tbl_privilege P
			JOIN tbl_menu_detail MD ON MD.menu_id = P.menu_id AND p.menu_detail_id = MD.id
			AND MD.status = 1 
			AND P.status = 1
			JOIN tbl_user U ON U.user_group_id = P.user_group_id
			JOIN tbl_action MA ON MA.ID = MD.action_id 
			AND MA.action_name = '$action' 
			JOIN tbl_menu_web M ON M.ID = P.menu_id
			AND P.status = 1 
			AND M.status = 1 
			AND M.slug = '$slug'
			WHERE
			U.user_group_id = $user_group_id 
			AND P.status = 1
			ORDER BY
			M.ORDER ASC");
		return $query->result();
	}
}

/* End of file M_global.php */
/* Location: ./application/models/M_global.php */