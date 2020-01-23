<?php
class M_dashboard extends CI_Model {

	public function __construct() {
		parent::__construct();
        $this->group_session = $this->session->userdata('group_id');
		$this->operator_cs_id = $this->enc->decode($this->session->userdata('operator_cs_id'));
	}

	public function dataList(){
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$search = $this->input->post('search');

		$operator = $this->enc->decode($this->input->post('operator'));

		$order = $this->input->post('order');
		$order_column = $order[0]['column'];
		$order_dir = strtoupper($order[0]['dir']);
		$iLike        = trim(strtoupper($this->db->escape_like_str($search['value'])));

		$field = array(
			0 =>'plaza_name',
			// 1 =>'order_date',
			// 2 =>'operator_name',
			// 3 =>'transponder_name',
			// 4 =>'qty',
			// 5 =>'price',
			// 6 =>'satuan_id',
			// 7 =>'delivery_date',
			// 9 =>'status_order_id',
		);

		$order_column = $field[$order_column];

		$where = " WHERE SS.status = 1";

		if ($this->group_session == 4) {
			$where .= "AND PP.operator_code IN (SELECT operator_code FROM app.t_mtr_operator WHERE id = '$this->operator_cs_id')";
		}

		if(!empty($search['value']))
		{
			$where .=" AND (operator_name ilike '%".$search['value']."%')";
		}

		$sql = "SELECT
					plaza_name, 
				    COUNT(SS.id) filter (WHERE SS.id NOT IN (SELECT stock_id FROM app.t_trx_obu_pairing WHERE pairing_status = 1)) as avail_obu, 
				    COUNT(SS.id) filter (WHERE SS.id IN (SELECT stock_id FROM app.t_trx_obu_pairing WHERE pairing_status = 1)) as paired_obu
				FROM
					app.t_mtr_stock SS
					JOIN app.t_mtr_plaza PP ON PP.id_seq = SS.plaza_id
				$where
				GROUP BY
					PP.plaza_name";

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
			$row->number = $i;

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

	function total_obu(){

		// $where = "AND a.payment_date BETWEEN '{$date} 00:00:00' AND '{$date2} 23:59:59' AND LOWER(a.channel) {$not} IN ('web','mobile') {$where_origin} ";

		$sql = "SELECT COUNT(*) FROM app.t_mtr_stock WHERE status = 1";

		return $this->db->query($sql)->row()->count;
	}

	function total_paired()
	{
		$sql = "SELECT COUNT(*) FROM app.t_mtr_stock WHERE status = 1 AND id IN (SELECT stock_id FROM app.t_trx_obu_pairing)";

		return $this->db->query($sql)->row()->count;
	}

	function request_order()
	{
		$sql = "SELECT COUNT(*) FROM app.t_trx_order_operator WHERE status_order_id = 1";

		return $this->db->query($sql)->row()->count;
	}

	function obu_reject()
	{
		$sql = "SELECT COUNT(*) FROM app.t_mtr_stock WHERE condition = 3";

		return $this->db->query($sql)->row()->count;
	}

	function get_total_trx_booking($vehicle=false){
		$date         = $this->input->post('date');
		$date2        = $this->input->post('date2');

		$origin       = $this->enc->decode($this->input->post('origin'));
		$service      = 1;
		$type_booking = 'passanger';

		if($vehicle){
			$service = 2;
			$type_booking = 'vehicle';
		}

	// check apakah ini di pelabuhan
		$where_origin="";
		if($origin!=0)
		{
			$where_origin=" AND c.origin ={$origin}";
		}

		$sql = "SELECT COUNT(0)
		FROM
		app.t_trx_payment a
		JOIN app.t_trx_booking b ON a.trans_number = b.trans_number
		JOIN app.t_trx_booking_{$type_booking} c ON b.booking_code = c.booking_code 
		WHERE
		b.service_id = {$service} AND a.payment_date BETWEEN '{$date} 00:00:00' AND '{$date2} 23:59:59' $where_origin ";

		return $this->db->query($sql)->row()->count;
	}

	function get_total_trx_boarding(){
		$date   = $this->input->post('date');
		$date2  = $this->input->post('date2');

		$origin = $this->enc->decode($this->input->post('origin'));

		$where_origin="";
		if($origin!=0)
		{
			$where_origin=" AND c.origin ={$origin}";
		}

		$sql = "SELECT COUNT(0) 
		FROM
		app.t_trx_boarding_passanger a
		JOIN app.t_trx_booking_passanger b ON a.ticket_number = b.ticket_number
		JOIN app.t_trx_booking c ON b.booking_code = c.booking_code 
		WHERE
		b.service_id = 1 AND a.boarding_date BETWEEN '{$date} 00:00:00' AND '{$date2} 23:59:59' {$where_origin} ";

		return $this->db->query($sql)->row()->count;
	}

	function get_total_trx_boarding_vehicle(){
		$date   = $this->input->post('date');
		$date2  = $this->input->post('date2');

		$origin = $this->enc->decode($this->input->post('origin'));

		$where_origin="";
		if($origin!=0)
		{
			$where_origin=" AND c.origin ={$origin}";
		}

		$sql = "SELECT COUNT(0) 
		FROM
		app.t_trx_boarding_vehicle a
		JOIN app.t_trx_booking_vehicle b ON a.ticket_number = b.ticket_number
		JOIN app.t_trx_booking c ON b.booking_code = c.booking_code 
		WHERE
		b.service_id = 2 AND a.boarding_date BETWEEN '{$date} 00:00:00' AND '{$date2} 23:59:59' {$where_origin} ";

		return $this->db->query($sql)->row()->count;
	}

	function get_ticket_revenue($in){
		$date = $this->input->post('date');
		$date2 = $this->input->post('date2');

		$origin = $this->enc->decode($this->input->post('origin'));
		
		if($in){
			$not = '';
		}else{
			$not = 'NOT';
		}

		$where_origin="";
		if($origin!=0)
		{
			$where_origin=" AND b.origin ={$origin}";
		}    

		$where = "AND a.payment_date BETWEEN '{$date} 00:00:00' AND '{$date2} 23:59:59' AND LOWER(a.channel) {$not} IN ('web','mobile') {$where_origin}";

		$sql = "SELECT COALESCE(sum1, 0) + COALESCE(sum2, 0) AS sum
		FROM (SELECT (SELECT SUM(amount) FROM (SELECT
		DISTINCT a.id, a.amount
		FROM
		app.t_trx_payment a
		JOIN app.t_trx_booking b ON a.trans_number = b.trans_number
		JOIN app.t_trx_booking_passanger c ON b.booking_code = c.booking_code
		WHERE b.service_id = 1 {$where}) trx1) AS sum1,

		(SELECT SUM(amount) FROM (SELECT
		DISTINCT a.id, a.amount
		FROM
		app.t_trx_payment a
		JOIN app.t_trx_booking b ON a.trans_number = b.trans_number
		JOIN app.t_trx_booking_vehicle c ON b.booking_code = c.booking_code
		WHERE b.service_id = 2 {$where}) trx2) AS sum2) a";

		return $this->db->query($sql)->row()->sum;
	}

	function get_trx_days($day){
		$origin = $this->enc->decode($this->input->post('origin'));
		$date   = $this->input->post('date');
		$date2  = $this->input->post('date2');

		$where_origin="";
		if($origin!=0)
		{
			$where_origin=" AND b.origin ={$origin}";
		}    

		$sql = "SELECT date_trunc('day', trx)::date AS date,
		(SELECT COUNT(0)
		FROM
		app.t_trx_payment a
		JOIN app.t_trx_booking b ON a.trans_number = b.trans_number
		JOIN app.t_trx_booking_passanger c ON b.booking_code = c.booking_code 
		WHERE b.service_id = 1 AND a.payment_date::date = date_trunc('day', trx)::date {$where_origin} ) AS total_penumpang,

		(SELECT COUNT(0)
		FROM
		app.t_trx_payment a
		JOIN app.t_trx_booking b ON a.trans_number = b.trans_number
		JOIN app.t_trx_booking_vehicle c ON b.booking_code = c.booking_code 
		WHERE b.service_id = 2 AND a.payment_date::date = date_trunc('day', trx)::date {$where_origin} ) AS total_kendaraan
		FROM generate_series( '{$date2}'::TIMESTAMP - INTERVAL '{$day} DAY', '{$date2}'::TIMESTAMP, '1 day'::interval) trx";

		$arr = array();
		$data = $this->db->query($sql)->result();

		foreach ($data as $row) {
			$arr['date'][]  = date('d M Y', strtotime($row->date));
			$arr['total'][] = $row->total_penumpang + $row->total_kendaraan;
		}

		return $arr;
	}

	function list_port(){
		

		$where = '';
		
		$data  = array();

		if($this->get_identity_app()==0)
		{
			if(!empty($this->session->userdata('port_id')))
			{
				$where .= "AND id =".$this->session->userdata('port_id');
			}
			else
			{
				$where .="";
				$data[$this->enc->encode(0)]="SEMUA PELABUHAN";
			}
		}
		else
		{
			$where .= "AND id =".$this->get_identity_app();
		}
		
		$query = $this->db->query("SELECT id, name FROM app.t_mtr_port WHERE status = 1 {$where} ORDER BY name ASC")->result();

		foreach ($query as $row) {
			$data[$this->enc->encode($row->id)] = $row->name;  
		}
		return $data;
	}

	public function get_identity_app()
	{
		$data=$this->db->query(" select * from app.t_mtr_identity_app")->row();

		return $data->port_id;
	}

}
