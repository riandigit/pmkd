<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {
	public function message_404()
	{
		$this->load->view('error_404');
	}
}
