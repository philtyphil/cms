<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');$this->load->library('session');
		$this->css = array(
			
			config_item('bootstrap'),
			config_item('bootstrap.min'),
			config_item('Css_Login')
		);
		
		$this->javascript = array(
			config_item('jquery'),
			config_item('js_bootstrap'),
			config_item('js_bootstrap_min'),
			config_item('login')
		);
		
	}
	public function index()
	{
		$view['title']		= "Login Page - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$this->output->cache("2");
		$this->load->view('login_view',$view);
	}
	
	function check()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			
		if($this->form_validation->run() == FALSE)
		{
			if(validation_errors('username')!=NULL)
			{
				$view['error_username'] = strip_tags(form_error('username'));
			}
			if(validation_errors('password')!=NULL)
			{
				$view['error_password'] = strip_tags(form_error('password'));
			}
			$this->session->sess_destroy();
			$view['title']		= "Login Page - Philtyphil";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$this->load->view('login_view',$view);
		}
		else
		{
			
			$this->load->library('RoleAccess');
			$data = $this->roleaccess->doLogin($this->input->post("username"),$this->input->post("password"),true);
	
			if($data != false)
            {
				/*
				|------------------------
				| Logged - Set Session - philtyphil
				|------------------------
				*/
				$data_session = array(
					"logged"		=> true,
					"role_id"		=> $data[0]['role_id'],
					"username"		=> $data[0]['username'],
					"nama_lengkap"	=> $data[0]['nama_lengkap']
				);
				$this->session->set_userdata($data_session);
				redirect(config_item('base_url').'dashboard', 'refresh');
            }
            else
            {
				/*
				|-----------------------------------
				| Not Logged - Id not found - philtyphil
				|-----------------------------------------
				*/
				$this->session->sess_destroy();
				$view['title']		= "Login Page - Philtyphil";
				$view['javascript'] = $this->javascript;
				$view['css']		= $this->css;
				$view['error']		= "Username or Password Not Found!!";
				$this->load->view('login_view',$view);
            }
			
		}
       
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */