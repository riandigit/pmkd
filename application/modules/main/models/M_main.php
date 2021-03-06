<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_main extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->_module = 'configuration/group';
	}
	public function Gbkp()
	{

		$qry = $this->db->query('SELECT id_seq,nama FROM tbl_gbkp')->result();

		return $qry;
	}
	public function getAkun($id)
	{
		$qry = $this->db->query("SELECT u.* , g.nama as runggun FROM tbl_user u left join tbl_gbkp g on u.runggun_id = g.id_seq where id = '$id'")->row();
		return $qry;
	}
	public function getPekerjaan(){
		$qry = $this->db->query('SELECT kdpekerjaan as id_seq,nmpekerjaan as nama FROM pekerjaan')->result();

		return $qry;
	}
	public function getPendidikan(){
		$qry = $this->db->query('SELECT kdpendidikan as id_seq,nmpendidikan as nama FROM pendidikan')->result();

		return $qry;
	}
}
