<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('usermodel');
        $this->load->library('session');
		$this->css = array(
			
			config_item('metrolab_bootstrap'),
			config_item('metrolab_bootstrap_responsive'),
			config_item('metrolab_bootstrap_fileupload'),
			config_item('metrolab_bootstrap_style'),
			config_item('metrolab_bootstrap_fontawesome'),
			config_item('metrolab_bootstrap_style_responsive'),
			config_item('metrolab_bootstrap_style_default'),
			config_item('metrolab_bootstrap_fancybox'),
			config_item('metrolab_bootstrap_uniforms'),
			config_item('metrolab_bootstrap_toggle_css'),
			config_item('metrolab_bootstrap_tagsinput'),
			config_item('metrolab_bootstrap_choosen_css'),
			config_item('metrolab_bootstrap_clockface')
			
		);
		
		$this->javascript = array(
			config_item('metrolab_jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_datatables'),
			config_item('metrolab_bootstrap_DT'),
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_dynamic'),
			config_item('metrolab_bootstrap_form-validate'),
			config_item('metrolab_bootstrap_form-validation'),
			config_item('metrolab_bootstrap_choosen'),
			config_item('metrolab_bootstrap_toggle'),
			config_item('admin_dashboard')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Dashboard - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		if($this->session->userdata("logged"))
		{
			$this->load->view('admin/admin_dashboard_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		} 	
	}
	
	function getusers()
	{
		if($this->session->userdata("logged"))
		{
			$data = $this->usermodel->getusers();
			echo json_encode($data);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function addUser()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->library('form_validation');
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'trim|required');
				
				if($this->form_validation->run() == FALSE)
				{
					if(validation_errors('username')!=NULL){
						$view['error_username'] = strip_tags(form_error('username'));
					}
					if(validation_errors('password')!=NULL){
						$view['error_password'] = strip_tags(form_error('password'));
					}
					//$this->load->view('admin_view',$view);
				}
				else
				{
					$data = $this->usermodel->adduser($this->input->post());
					if($data)
					{
						$view['notif'] = "Add User Success";
					}
					
				}
				echo json_encode($view);
			}
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function loaduser()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->view("content/user/userlist");
		}
		
	}
	
	function deleteuser($username)
	{
		if($this->session->userdata("logged"))
		{
			if(preg_match("/^[a-zA-Z ]*$/", $username))
			{
				$data = $this->usermodel->deleteuser($username);
				return $data;
			}
			else
			{
				return false;
			}
		}
	}
	
	function loadmenu()
	{
		if($this->session->userdata("logged")) 
		{
			$this->load->library("menuroleaccess");
			$view["data"] = $this->menuroleaccess->checkAccessMenu($this->session->userdata("role_id"));
			$this->load->view("menu",$view);
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */