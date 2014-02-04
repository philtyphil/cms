<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');$this->load->helper('url');
		
		
	}
	public function index()
	{
		$this->session->sess_destroy();
		redirect(config_item('base_url').'login', 'refresh');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */