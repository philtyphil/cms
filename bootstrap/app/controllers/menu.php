<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');$this->load->model('menuadminmodel');$this->load->library('session');
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
			config_item('admin_menu')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Dashboard - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		if($this->session->userdata("logged"))
		{
			$this->load->view('admin/manage_menu/admin_menu_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}

	function getlistmenu()
	{
		if($this->session->userdata("logged"))
		{
			$data = $this->menuadminmodel->getlistmenu();
			echo json_encode($data);
		}
		
	}
	
	function getlistmenuwebsite()
	{
		if($this->session->userdata("logged"))
		{
			$data = $this->menuadminmodel->getlistmenuwebsite();
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
					$data = $this->adminmodel->adduser($this->input->post());
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
	
	function deletemenu()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id', 'ID', 'trim|numeric');
			if($this->form_validation->run() == TRUE)
			{
				$data = $this->menuadminmodel->deletemenu($this->input->post("key"));
				if($data)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	function deletesubmenu()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('id', 'ID', 'trim|numeric');
			if($this->form_validation->run() == TRUE)
			{
				$data = $this->menuadminmodel->deletesubmenu($this->input->post("key"));
				if($data)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
	function loadmenu()
	{
		if($this->session->userdata("logged")) 
		{
			$this->load->library("menuaccess");
			$view["data"] = $this->menuaccess->checkAccessMenu($this->session->userdata("role_id"));
			$this->load->view("menu",$view);
		}
	}
	
	function loadmenulist()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
			$this->load->view("content/menu/menulist");
		}
	}
	
	function loadmenuwebsitelist()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
			$this->load->view("content/menu/menuwebsitelist");
		}
	}
	
	function edit($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
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
				config_item('edit_menu')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Edit";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['data']		= $this->menuadminmodel->geteditmenulist($id);
			$view['submenu']	= $this->menuadminmodel->getsubmenuadmin();
            $view['id']         = $id;
			
			$this->load->view('admin/manage_menu/edit_menu',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	function editsub($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
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
				config_item('edit_menu_sub')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Edit";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['data']		= $this->menuadminmodel->geteditmenusublist($id);
			$view['submenu']		= $this->menuadminmodel->getsubmenuadmin($id);
            $view['id']             = $id;
			$this->load->view('admin/manage_menu/edit_menu_sub',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
        
    function editsave()
    {
        $this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'ID', 'trim|numeric');
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
            $this->form_validation->set_rules('link', 'Link', 'trim|required');
            $this->form_validation->set_rules('aktif', 'Active', 'trim|required');  
            $this->form_validation->set_rules('namamenu', 'Name Menu', 'trim|required|min_length[5]');  
           
            if($this->form_validation->run() == TRUE)
            {
                
                    $data = $this->menuadminmodel->editsave($this->input->post());
                    if($data)
                    {
                        $notif["success"] = "ok";
                        echo json_encode($notif);
                    }
                    else
                    {
                        $data["error"] = "Try again later!!";
                        echo json_encode($data);
                    }
            }
            else
            {
                
                if(validation_errors('icon')!=NULL){
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
                if(validation_errors('link')!=NULL){
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                if(validation_errors('aktif')!=NULL)
                {
                    $view['error_aktif'] = strip_tags(form_error('aktif'));
                }
                 if(validation_errors('namamenu')!=NULL)
                {
                    $view['error_nama'] = strip_tags(form_error('namamenu'));
                }
                echo json_encode($view);
            }
        }
    }/* End Of function Editsave */
	
	function editsaveSubmenu()
    {
        $this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_sub', 'Critical Error', 'trim|numeric');
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
            $this->form_validation->set_rules('link_sub', 'Link', 'trim|required');
            $this->form_validation->set_rules('aktif', 'Active', 'trim|required');  
            $this->form_validation->set_rules('nama_sub', 'Name Menu', 'trim|required|min_length[2]');  
            $this->form_validation->set_rules('description', 'Name Menu', 'trim|required|min_length[14]');  
           
            if($this->form_validation->run() == TRUE)
            {
                
                    $data = $this->menuadminmodel->editsavesubmenu($this->input->post());
                    if($data)
                    {
                        $notif["success"] = "ok";
                        echo json_encode($notif);
                    }
                    else
                    {
                        $data["error"] = "Try again later!!";
                        echo json_encode($data);
                    }
            }
            else
            {
				if(validation_errors('description')!=NULL){
                    $view['error_description'] = strip_tags(form_error('description'));
                }
                if(validation_errors('id_sub')!=NULL){
                    $view['error_id_sub'] = strip_tags(form_error('id_sub'));
                }
                if(validation_errors('icon')!=NULL){
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
                if(validation_errors('link')!=NULL){
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                if(validation_errors('aktif')!=NULL)
                {
                    $view['error_aktif'] = strip_tags(form_error('aktif'));
                }
                 if(validation_errors('nama_sub')!=NULL)
                {
                    $view['error_nama_sub'] = strip_tags(form_error('nama_sub'));
                }
                echo json_encode($view);
            }
        }
    }
	function add()
	{
		if($this->session->userdata("logged"))
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
				config_item('add_menu')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Add Menu Admin";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['submenu']	= $this->menuadminmodel->submenu();
            
			$this->load->library("MenuRoleAccess");
			$role = $this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class());
			if($role)
			{
				$this->load->view('admin/manage_menu/add_menu',$view);
			}
			else
			{
				redirect(config_item('base_url').'login', 'refresh');
			}
			
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function saveAdd()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
			/** validation error dulu **/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_menu', 'Nama menu', 'trim|required');
            $this->form_validation->set_rules('class', 'Class', 'trim|required|callback_classExist');
            $this->form_validation->set_rules('link', 'Link', 'trim|required'); 
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required'); 
			if($this->form_validation->run() == TRUE)
            {
				$view["success"] = $this->menuadminmodel->saveAdd($this->input->post());
			}
			else
			{
				if(validation_errors('nama_menu')!=NULL){
                    $view['error_nama_menu'] = strip_tags(form_error('nama_menu'));
                }
                if(validation_errors('class')!=NULL){
                    $view['error_class'] = strip_tags(form_error('class'));
                }
                if(validation_errors('link')!=NULL)
                {
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                 if(validation_errors('icon')!=NULL)
                {
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
			}
			echo json_encode($view);
			
			
		}
	}
	/** function cek nama class untuk form Add **/
	function classExist($key)
	{
		if($this->session->userdata("logged"))
		{
			$data = $this->menuadminmodel->cekClass($key);
			if($data)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}
	
	function addKategori()
	{
		if($this->session->userdata("logged"))
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
				config_item('add_kategori')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Add Menu Category Admin";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['menu']	= $this->menuadminmodel->mainmenu();
            
			$this->load->library("MenuRoleAccess");
			$role = $this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class());
			if($role)
			{
				$this->load->view('admin/manage_menu/add_menu_kategori',$view);
			}
			else
			{
				redirect(config_item('base_url').'login', 'refresh');
			}
			
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function addKategoriAdmin()
	{
		if($this->session->userdata("logged"))
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
				config_item('add_kategori_admin')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Add Menu Category Admin";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['menu']	= $this->menuadminmodel->mainmenuadmin();
            
			$this->load->library("MenuRoleAccess");
			$role = $this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class());
			if($role)
			{
				$this->load->view('admin/manage_menu/add_menu_kategori_admin',$view);
			}
			else
			{
				redirect(config_item('base_url').'login', 'refresh');
			}
			
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	function saveAddSubAdmin()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
			/** validation error dulu **/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_menu', 'Nama menu', 'trim|required');
            $this->form_validation->set_rules('link_sub', 'Link', 'trim|required'); 
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required'); 
            $this->form_validation->set_rules('aktif', 'Aktif', 'trim|required|alpha_numeric');  
            $this->form_validation->set_rules('sub_menu', 'Aktif', 'trim');  
			if($this->form_validation->run() == TRUE)
            {
				$view["success"] = $this->menuadminmodel->saveAddMenu($this->input->post());
			}
			else
			{
				if(validation_errors('nama_menu')!=NULL){
                    $view['error_nama_menu'] = strip_tags(form_error('nama_menu'));
                }
                if(validation_errors('class')!=NULL){
                    $view['error_class'] = strip_tags(form_error('class'));
                }
                if(validation_errors('link_sub')!=NULL)
                {
                    $view['error_link'] = strip_tags(form_error('link_sub'));
                }
                 if(validation_errors('icon')!=NULL)
                {
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
				 if(validation_errors('sub_menu')!=NULL)
                {
                    $view['error_sub_menu'] = strip_tags(form_error('sub_menu'));
                }
				if(validation_errors('sub_menu')!=NULL)
                {
                    $view['error_id_main'] = strip_tags(form_error('sub_menu'));
                }
			}
			echo json_encode($view);
			
			
		}
	}
	
	function addmenuwebsite()
	{
			if($this->session->userdata("logged"))
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
				config_item('add_menu_website')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Add Menu Admin";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['submenu']	= $this->menuadminmodel->submenuwebsite();
            
			$this->load->library("MenuRoleAccess");
			$role = $this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class());
			if($role)
			{
				$this->load->view('admin/manage_menu/add_menu_website',$view);
			}
			else
			{
				redirect(config_item('base_url').'login', 'refresh');
			}
			
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function saveAddMenuWebsite()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
			/** validation error dulu **/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('nama_menu', 'Nama menu', 'trim|required');
            $this->form_validation->set_rules('class', 'Class', 'trim|required|callback_classExist');
            $this->form_validation->set_rules('link', 'Link', 'trim|required'); 
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required'); 
			if($this->form_validation->run() == TRUE)
            {
				$view["success"] = $this->menuadminmodel->saveAddMenuWebsite($this->input->post());
			}
			else
			{
				if(validation_errors('nama_menu')!=NULL){
                    $view['error_nama_menu'] = strip_tags(form_error('nama_menu'));
                }
                if(validation_errors('class')!=NULL){
                    $view['error_class'] = strip_tags(form_error('class'));
                }
                if(validation_errors('link')!=NULL)
                {
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                 if(validation_errors('icon')!=NULL)
                {
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
			}
			echo json_encode($view);
			
			
		}
	}
	
	function deletemenuwebsite($id)
	{
		$data = $this->menuadminmodel->deletemenuwebsite(intval($id));
		if($data)
		{
			$view["success"] = "Deleting Success!!";
		}
		else
		{
			$view["failed"]	= "Error!! Deleting Failed";
		}
		echo json_encode($view);
		
	
	}
	
	function editmenuwebsite($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
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
				config_item('edit_menu_website')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Edit";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['data']		= $this->menuadminmodel->geteditmenuwebsitelist($id);
			$view['submenu']	= $this->menuadminmodel->getsubmenuwebsite($id);
            $view['id']         = $id;
			
			$this->load->view('admin/manage_menu/edit_menu_website',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function editsavewebsite()
    {
        $this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id', 'ID', 'trim|numeric');
            $this->form_validation->set_rules('icon', 'Icon', 'trim|required');
            $this->form_validation->set_rules('link', 'Link', 'trim|required');
            $this->form_validation->set_rules('aktif', 'Active', 'trim|required');  
            $this->form_validation->set_rules('namamenu', 'Name Menu', 'trim|required|min_length[3]');
           
            if($this->form_validation->run() == TRUE)
            {
                
                    $data = $this->menuadminmodel->editmenuwebsite($this->input->post());
                    if($data)
                    {
                        $notif["success"] = "ok";
                        echo json_encode($notif);
                    }
                    else
                    {
                        $data["error"] = "Try again later!!";
                        echo json_encode($data);
                    }
            }
            else
            {
                
                if(validation_errors('icon')!=NULL){
                    $view['error_icon'] = strip_tags(form_error('icon'));
                }
                if(validation_errors('link')!=NULL){
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                if(validation_errors('aktif')!=NULL)
                {
                    $view['error_aktif'] = strip_tags(form_error('aktif'));
                }
                 if(validation_errors('namamenu')!=NULL)
                {
                    $view['error_nama'] = strip_tags(form_error('namamenu'));
                }
				
                echo json_encode($view);
            }
        }
    }/* End Of function Editsave */
	
	function editsubwebsite($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
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
				config_item('edit_menu_sub_wesite')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Menu - Edit";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['data']		= $this->menuadminmodel->geteditmenusubwebsitelist($id);
			$view['submenu']	= $this->menuadminmodel->getsubmenuadmin($id);
            $view['id']            = $id;
			$this->load->view('admin/manage_menu/edit_menuwebsite_sub',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function deletesubmenuwebsite()
	{
		$data = $this->menuadminmodel->deletesubmenuwebsite($this->input->post("key"));
		if($data)
		{
			echo json_encode($data);
		}
		else
		{
			echo json_encode($data);
		}
	}
	
	function editsaveSubmenuwebsite()
    {
        $this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()) == TRUE )
		{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('id_sub', 'Critical Error', 'trim|numeric');
            $this->form_validation->set_rules('link_sub', 'Link', 'trim|required');
            $this->form_validation->set_rules('aktif', 'Active', 'trim|required');  
            $this->form_validation->set_rules('nama_sub', 'Name Menu', 'trim|required|min_length[2]'); 
           
            if($this->form_validation->run() == TRUE)
            {
                
                    $data = $this->menuadminmodel->editsavesubmenuwebsite($this->input->post());
                    if($data)
                    {
                        $notif["success"] = "ok";
                        echo json_encode($notif);
                    }
                    else
                    {
                        $data["error"] = "Try again later!!";
                        echo json_encode($data);
                    }
            }
            else
            {
				if(validation_errors('id_sub')!=NULL){
                    $view['error_id_sub'] = strip_tags(form_error('id_sub'));
                }
                if(validation_errors('link')!=NULL){
                    $view['error_link'] = strip_tags(form_error('link'));
                }
                if(validation_errors('aktif')!=NULL)
                {
                    $view['error_aktif'] = strip_tags(form_error('aktif'));
                }
                 if(validation_errors('nama_sub')!=NULL)
                {
                    $view['error_nama_sub'] = strip_tags(form_error('nama_sub'));
                }
                echo json_encode($view);
            }
        }
    }
	
}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */