<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encrypt extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('start');
		$this->load->view('footer');
	}
}
