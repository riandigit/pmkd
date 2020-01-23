<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('m_dashboard','dashboard');
	}

	function index() {
		checkUrlAccess(uri_string(),'view');

		checkUrlAccess(uri_string(),'view');
		if($this->input->is_ajax_request()){
			$rows = $this->dashboard->dataList();
			echo json_encode($rows);
			exit;
		}

		$data = array(
			'home'      => 'Home',
			'url_home'  => site_url('home'),
			'title'     => 'Dashboard',
			'content'   => 'index',
		);

		$this->load->view('default', $data);
	}

	function listDashboard(){
		validate_ajax();

		$data = array(
			'total_obu' => $this->dashboard->total_obu(),
			'total_paired' => $this->dashboard->total_paired(),
			'request_order' => $this->dashboard->request_order(),
			'obu_reject' => $this->dashboard->obu_reject(),
			// 'total_passenger' => $this->dashboard->get_total_trx_booking(),
			// 'total_vehicle' => $this->dashboard->get_total_trx_booking(true),
			// 'boarding_passenger' => $this->dashboard->get_total_trx_boarding(),
			// 'boarding_vehicle' => $this->dashboard->get_total_trx_boarding_vehicle(),
			// 'volume_ticket' => array(
			// 	'ticket' => array('Go Show','Online'),
			// 	'total' => array(
			// 		array('value' => $this->dashboard->get_ticket_volume(false), 'name' => 'Go Show'),
			// 		array('value' => $this->dashboard->get_ticket_volume(true), 'name' => 'Online'),
			// 	)
			// ),
			// 'revenue_ticket' => array(
			// 	'ticket' => array('Go Show','Online'),
			// 	'total' => array(
			// 		array('value' => $this->dashboard->get_ticket_revenue(false), 'name' => 'Go Show'),
			// 		array('value' => $this->dashboard->get_ticket_revenue(true), 'name' => 'Online'),
			// 	)
			// ),
			// 'days' => $this->dashboard->get_trx_days($day)
		);

		$response = json_api(1,'List Dasboard',$data);

		echo $response;
	}

	function listDashboard_old(){
		validate_ajax();
		$post = $this->input->post();

		if($post['date'] > $post['date2']){
			$response = json_api(0,'Start date lebih besar dari end date');
		}else{
			$diff = date_diff(date_create($post['date']),date_create($post['date2']));
			$d    = $diff->format('%a');

			if($d > 6){
				$day = $d;
			}else{
				$day = 6;
			}

			$data = array(
				'count_stock' => $this->dashboard->count_stock(),
				'total_passenger' => $this->dashboard->get_total_trx_booking(),
				'total_vehicle' => $this->dashboard->get_total_trx_booking(true),
				'boarding_passenger' => $this->dashboard->get_total_trx_boarding(),
				'boarding_vehicle' => $this->dashboard->get_total_trx_boarding_vehicle(),
				'volume_ticket' => array(
					'ticket' => array('Go Show','Online'),
					'total' => array(
						array('value' => $this->dashboard->get_ticket_volume(false), 'name' => 'Go Show'),
						array('value' => $this->dashboard->get_ticket_volume(true), 'name' => 'Online'),
					)
				),
				'revenue_ticket' => array(
					'ticket' => array('Go Show','Online'),
					'total' => array(
						array('value' => $this->dashboard->get_ticket_revenue(false), 'name' => 'Go Show'),
						array('value' => $this->dashboard->get_ticket_revenue(true), 'name' => 'Online'),
					)
				),
				'days' => $this->dashboard->get_trx_days($day)
			);

			$response = json_api(1,'List Dasboard',$data);
		}

		echo $response;
	}
}
