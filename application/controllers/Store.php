<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	public function index()
	{
		$this->load->view('header');
		$this->load->view('store/store');
		$this->load->view('footer');
	}
}
