<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_main extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->_module = 'configuration/group';
	}
	public function Gbkp (){
		
			$qry = $this->db->query('SELECT id_seq,nama FROM tbl_gbkp')->result();
		
		
		return $qry;
	}
}