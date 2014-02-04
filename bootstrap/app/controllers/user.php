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
		$view['title']		= "Manage Menu - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$view["data"]	= $this->usermodel->users();
			$this->load->view('admin/manage_user/admin_dashboard_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		} 	
	}
	
	function getusers()
	{
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$data = $this->usermodel->getusers();
			echo json_encode($data);
		}
		
	}
	
	function addUser()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->library('form_validation');
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('no_telp', 'Phone Number', 'trim|required|numeric');
				$this->form_validation->set_rules('nama_lengkap', 'Your Name', 'trim|required');
				$this->form_validation->set_rules('blokir', 'blokir', 'trim|required');
				if($this->form_validation->run() == FALSE)
				{
					if(validation_errors('username')!=NULL){
						$view['error_username'] = strip_tags(form_error('username'));
					}
					if(validation_errors('password')!=NULL){
						$view['error_password'] = strip_tags(form_error('password'));
					}
					if(validation_errors('email')!=NULL){
						$view['error_email'] = strip_tags(form_error('email'));
					}
					if(validation_errors('no_telp')!=NULL){
						$view['error_notelp'] = strip_tags(form_error('no_telp'));
					}
					if(validation_errors('nama_lengkap')!=NULL){
						$view['error_namalengkap'] = strip_tags(form_error('nama_lengkap'));
					}
					if(validation_errors('blokir')!=NULL){
						$view['error_blokir'] = strip_tags(form_error('blokir'));
					}
				}
				else
				{
					$data = $this->usermodel->adduser($this->input->post());
					if($data)
					{
						$view['notif'] = "Add User Success!";
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
			foreach($view["data"] as $key => $value)
			{
				$data = $this->menuroleaccess->checkSubMenu($this->session->userdata("role_id"),$value["id_main"]);
				if(is_array($data) && count($data) > 0)
				{
					$view["data"][$key]["submenu"] = $data;
					
				}
			}
			$this->load->view("menu",$view);
		}
	}
	
	function add()
	{
		$this->javascript = array(
				config_item('metrolab_jquery'),
				config_item('metrolab_nicescroll'),
				config_item('metrolab_bootstrap_min_js'),
				config_item('metrolab_bootstrap_common'),
				config_item('metrolab_bootstrap_form-wizard-min'),
				config_item('metrolab_bootstrap_choosen'),
				config_item('metrolab_bootstrap_toggle'),
				config_item('metrolab_bootstrap_form-wizard'),
				config_item('metrolab_bootstrap_jsgritter'),
				config_item('metrolab_bootstrap_jspulstate'),
				config_item('metrolab_bootstrap_gritter'),
				config_item('metrolab_bootstrap_pulstate'),
				config_item('add_user')
		);
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Menu Add - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$view['role']		= $this->usermodel->getroleaccess();
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_user/add_user',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function edit($username)
	{
		$this->javascript = array(
				config_item('metrolab_jquery'),
				config_item('metrolab_nicescroll'),
				config_item('metrolab_bootstrap_min_js'),
				config_item('metrolab_bootstrap_common'),
				config_item('metrolab_bootstrap_form-wizard-min'),
				config_item('metrolab_bootstrap_choosen'),
				config_item('metrolab_bootstrap_toggle'),
				config_item('metrolab_bootstrap_form-wizard'),
				config_item('metrolab_bootstrap_jsgritter'),
				config_item('metrolab_bootstrap_jspulstate'),
				config_item('metrolab_bootstrap_gritter'),
				config_item('metrolab_bootstrap_pulstate'),
				config_item('edit_user')
		);
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage User Edit - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$view['role']		= $this->usermodel->getroleaccess();
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$view["data"] = $this->usermodel->getuseredit($username);
			$this->load->view("admin/manage_user/edit_user",$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function username_check($str)
	{
		$data = $this->usermodel->usernameCheck($str);
		if($data)
		{
			$this->form_validation->set_message('username_check', 'The %s already, change your %s username');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function editsave()
	{
		
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->library('form_validation');
			if($this->input->post("submit"))
			{
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('no_telp', 'Phone Number', 'trim|required|numeric');
				$this->form_validation->set_rules('nama_lengkap', 'Your Name', 'trim|required');
				$this->form_validation->set_rules('blokir', 'blokir', 'trim|required');
			
				
				if($this->form_validation->run() == FALSE)
				{
					if(validation_errors('username')!=NULL){
						$view['error_username'] = strip_tags(form_error('username'));
					}
					
					if(validation_errors('email')!=NULL){
						$view['error_email'] = strip_tags(form_error('email'));
					}
					if(validation_errors('no_telp')!=NULL){
						$view['error_notelp'] = strip_tags(form_error('no_telp'));
					}
					if(validation_errors('nama_lengkap')!=NULL){
						$view['error_namalengkap'] = strip_tags(form_error('nama_lengkap'));
					}
					if(validation_errors('blokir')!=NULL){
						$view['error_blokir'] = strip_tags(form_error('blokir'));
					}
					echo json_encode($view);
				}
				else
				{
					$data = $this->usermodel->saveedit($this->input->post());
					if($data)
					{
						$view["success"] = "Update User Success!!";
					}
					else
					{
						$view["error"] = "Can't To Update In server!. Please Check Your Connection.";
					}
					echo json_encode($view);
				}
			}
		}
	}
	
	function menuaccess($id)
	{
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$data = $this->usermodel->menuaccess($id);
			if($data)
			{
				$val["data"]	= $data;unset($data);
				echo json_encode($val);
			}
		}
	}
	
	function loadopt($id = "")
	{
		if($id != "")
		{
			//$view["sData"]			= $this->usermodel->menuadminselected($id);
			$view["sData"]			= $this->usermodel->menuadminUnselected($id);
			$view["sDataaSelected"]	= $this->usermodel->menuadmin($id);
			$this->load->view("content/user/selectoptionuser_menuaccess",$view);
		}
		else
		{
			return false;
		}
	}
	
	function savemenuaccess()
	{
		$this->load->library("menuroleaccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->library('form_validation');
			if($this->input->post("submit"))
			{
				$this->form_validation->set_rules('id_main', 'Group Access', 'required|numeric');
			}
			
			if($this->form_validation->run() == TRUE)
			{
				$data = $this->usermodel->updateaccessmenu($this->input->post());
				if($data)
				{
					unset($data);
					$data["success"]	= "Success Update Menu Access!!";
				}
				else
				{
					unset($data);
					$data["failed"]		= "Update Menu Access Failed!!";
				}
				echo json_encode($data);
			}
			else
			{
				if(validation_errors('id_main')!=NULL){
						$view['error_id_main'] = strip_tags(form_error('id_main'));
				}
				if(validation_errors('id_menu')!=NULL){
						$view['error_id_menu'] = strip_tags(form_error('id_menu'));
				}
				echo json_encode($view);
			}
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */