<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Berita extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('beritamodel');
        $this->load->library('session');
		$this->css = array(
			
			config_item('metrolab_bootstrap'),
			config_item('metrolab_bootstrap_responsive'),
			config_item('metrolab_bootstrap_fileupload'),
			config_item('metrolab_bootstrap_style'),
			config_item('metrolab_bootstrap_fontawesome'),			
			config_item('metrolab_bootstrap_fancybox'),
			config_item('metrolab_bootstrap_uniforms'),
			config_item('metrolab_bootstrap_toggle_css'),
			config_item('metrolab_bootstrap_tagsinput'),
			config_item('metrolab_bootstrap_choosen_css'),
			config_item('metrolab_bootstrap_timeline_component_css'),
			config_item('metrolab_bootstrap_style_responsive'),
			config_item('metrolab_bootstrap_style_default'),
			config_item('metrolab_bootstrap_clockface'),
			config_item('summernote_css')
			
		);
		
		$this->javascript = array(
			config_item('metrolab_jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_datatables'),
			config_item('metrolab_bootstrap_DT'),
			config_item('metrolab_bootstrap_dynamic'),
			config_item('metrolab_bootstrap_form-validate'),
			config_item('metrolab_bootstrap_form-validation'),
			config_item('metrolab_bootstrap_choosen'),
			config_item('metrolab_bootstrap_toggle'),
			config_item('metrolab_bootstrap_fancyboxs'),			
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_jQueryTagsInputJs'),
			config_item('summernoteJS'),
			config_item('admin_berita')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Berita - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_berita/admin_berita_view',$view);
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
			$data = $this->adminmodel->getusers();
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
	
	function loadberitalist()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->view("content/berita/berita_list");
		}
		
	}
	function loadberitawidgetlist($id)
	{
		if($this->session->userdata("logged"))
		{
			$view["id"] = $id;
			$this->load->view("content/berita/berita_widget_list",$view);
		}
	}
	function deleteuser($username)
	{
		if($this->session->userdata("logged"))
		{
			if(preg_match("/^[a-zA-Z ]*$/", $username))
			{
				$data = $this->adminmodel->deleteuser($username);
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
			$this->load->library("MenuRoleAccess");
			$view["data"] = $this->menuroleaccess->checkAccessMenu($this->session->userdata("role_id"));
			$this->load->view("menu",$view);
		}
	}
	
	function getberita()
	{
		$data = $this->beritamodel->getberita();
		echo json_encode($data);
	}
	
	function edit($id)
	{
		$this->javascript = array(
			config_item('jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_datatables'),
			config_item('metrolab_bootstrap_DT'),
			config_item('metrolab_bootstrap_dynamic'),
			config_item('metrolab_bootstrap_form-validate'),
			config_item('metrolab_bootstrap_form-validation'),
			config_item('metrolab_bootstrap_choosen'),
			config_item('metrolab_bootstrap_toggle'),
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_fileuploads'),			
			config_item('metrolab_bootstrap_jQueryTagsInputJs'),
			config_item('ckeditor'),
			config_item('admin_berita')
		);
		$view['data'] 		= $this->beritamodel->getberitaedit($id);
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Berita - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_berita/edit_berita',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		} 
		
	}
	
	function saveedit()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			if($this->input->post("submit"))
			{
				$this->load->library('form_validation');
				$this->form_validation->set_rules('isi_berita', 'News', 'trim|required|min_length[24]|xss_clean');
				$this->form_validation->set_rules('gambar', 'Image', 'trim|xss_clean');
				$this->form_validation->set_rules('judul', 'Title', 'trim|required');
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('last_edit', 'Last Edit', 'trim|required'); 
				$this->form_validation->set_rules('id_berita', 'ID', 'trim|required|numeric'); 
			
				if($this->form_validation->run() == TRUE)
				{
					
					$data = $this->beritamodel->updateBerita($this->input->post());
					if($data)
					{
						$view["success"] = "Edited.";
					}
				}
				else
				{
					 if(validation_errors('isi_berita')!=NULL){
                    $view['error_isi_berita'] = strip_tags(form_error('isi_berita'));
					}
					if(validation_errors('judul')!=NULL){
						$view['error_judul'] = strip_tags(form_error('judul'));
					}
					if(validation_errors('username')!=NULL)
					{
						$view['error_username'] = strip_tags(form_error('username'));
					}
					if(validation_errors('last_edit')!=NULL)
					{
						$view['error_last_edit'] = strip_tags(form_error('last_edit'));
					}
					if(validation_errors('edit_id')!=NULL)
					{
						$view['error_edit_id'] = strip_tags(form_error('edit_id'));
					}					
				}
				echo json_encode($view);
			}
		}
	}
	
	function del($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$del = $this->beritamodel->delete(intval($id));
			if($del)
			{
				$data["success"] = "success";
			}
			echo json_encode($data);
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
				config_item('metrolab_bootstrap_form-wizard'),
				config_item('metrolab_bootstrap_jsgritter'),
				config_item('metrolab_bootstrap_jspulstate'),
				config_item('metrolab_bootstrap_gritter'),
				config_item('metrolab_bootstrap_pulstate'),				
				config_item('metrolab_bootstrap_fileuploads'),
				config_item('metrolab_bootstrap_jQueryTagsInputJs'),
				config_item('metrolab_bootstrap_choosen'),
				config_item('summernoteJS'),
				config_item('add_berita')
		);
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Add Berita - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$view['kategori']	= $this->beritamodel->ALL_KATEGORI();
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_berita/add_berita',$view);
		}
		else
		{
			redirect(config_item('base_url').'login/check', 'refresh');
		} 
	}
	
	function saveAddBerita()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			if($this->input->post("submit"))
			{
				$this->load->library("form_validation");
				$this->form_validation->set_rules('isi_berita', 'News', 'trim|required|min_length[24]|xss_clean');
				$this->form_validation->set_rules('judul', 'Title', 'trim|required');
				$this->form_validation->set_rules('tags', 'Tag', 'trim');
			
				if($this->form_validation->run() == TRUE)
				{
					$holdOn 	 = "";
					$change		 = str_replace("|",",",$this->input->post("tags"));
					$holdTags 	 = explode("|",$this->input->post("tags"));
					for($i = 0;$i<count($holdTags);$i++)
					{
						if(substr($holdTags[$i],0,1) != "#")
						{
							$holdTags[$i] =  "#".$holdTags[$i];
							$holdOn 	  = $holdOn.",".$holdTags[$i];
						}
					}
					$judulSEO 	= preg_replace('/[^a-zA-Z0-9\']/',"_",$this->input->post("judul"));
					$judulSEO 	= $judulSEO . ".html";
					unset($holdTags);
					/*
					--------------------------
					|	Preparing Date Insert
					--------------------------
					*/
					$NamaHari	= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
					$hari		= date("w");
					$prepareData = array(
						"id_kategori"	=> $this->input->post("kategori"),
						"username"	=> $this->session->userdata("username"),
						"judul"		=> $this->input->post("judul"),
						"judul_seo"	=> $judulSEO,
						"headline"	=> "Y",
						"isi_berita"=> $this->input->post("isi_berita"),
						"hari"		=> $NamaHari[$hari],
						"tanggal"	=> date("Y-m-d"),
						"jam"		=> date("H:i:s"),
						"tag"		=> ltrim($holdOn,","),
						"gambar"	=> $this->input->post("gambar")
					);
					
					$data = $this->beritamodel->insertberita($prepareData);
					if($data)
					{
						$f["success"] = "Add News Success!!";
					}
					else
					{
						$f["failure"] 	= "Add News Failed, Check your internet connection!!";
					}
				}
				else
				{
					if(validation_errors('isi_berita')!=NULL)
					{
						$f['error_isi_berita'] = strip_tags(form_error('isi_berita'));
					}
					if(validation_errors('judul')!=NULL)
					{
						$f['error_judul'] = strip_tags(form_error('judul'));
					}
					if(validation_errors('tags')!=NULL)
					{
						$f['error_tags'] = strip_tags(form_error('tags'));
					}
				}
				echo json_encode($f);

			}
		
		}
	}
	
	function checkJudul()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->library("form_validation");
			$this->form_validation->set_rules('judul', 'Title', 'trim|required|alpha_numric');
			if($this->form_validation->run() == TRUE)
			{
				$data = '<span class="input-success tooltips" data-original-title="Success input!"><i class="icon-ok"></i></span> OK!';
			}
			else
			{
				$data = '<span class="input-error tooltips" data-original-title="'. strip_tags(form_error('judul')).'"><i class="icon-exclamation-sign"></i></span> '.strip_tags(form_error('judul'));
			}
			echo json_encode($data);
		}
	}
	
	function uploadImage()
	{
		
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->helper('img');
			$data = img($_FILES,"600","352","beritaheader"); 
			if($data)
			{
				$notif = "SUCCESS";
				header('Content-type: text/json');
				echo json_encode($notif);
			}
			else
			{
				echo json_encode("");

			}
		}
		exit();
	}
	function uploadImageSinglePost()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->helper('img');
			$data = img($_FILES,"900","182","singlepost"); 
			if($data)
			{
				$notif = "SUCCESS";
				header('Content-type: text/json');
				echo json_encode($notif);
			}
			else
			{
				echo json_encode("");

			}
		}
		exit();
	}
	function uploadImageBW()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			
			$this->load->helper('imgBW');
			$data = imgBW($_FILES,"280","280","imgBW");
			if($data)
			{
				$notif = "SUCCESS";
				header('Content-type: text/json');
				echo json_encode($notif);
			}
			else
			{
				echo json_encode("");

			}
		}
		exit();
	}

	
	function widget($kategori)
	{
		$this->javascript = array(
			config_item('metrolab_jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_datatables'),
			config_item('metrolab_bootstrap_DT'),
			config_item('metrolab_bootstrap_dynamic'),
			config_item('metrolab_bootstrap_form-validate'),
			config_item('metrolab_bootstrap_form-validation'),
			config_item('metrolab_bootstrap_choosen'),
			config_item('metrolab_bootstrap_toggle'),
			config_item('metrolab_bootstrap_fancyboxs'),			
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_jQueryTagsInputJs'),
			config_item('admin_berita_widget')
		);
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Manage Berita - Philtyphil";
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['function']	= $this->router->fetch_class();
			$view['id']			= $kategori;
			$view['widget']		= $this->beritamodel->getwidgetname($kategori);
			$this->load->view('admin/manage_berita/admin_berita_widget_view',$view);
		}
	}
	
	function getwidget($id)
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$data = $this->beritamodel->getwidget($id);
			echo json_encode($data);
		}
	}
	
	function widgetadd($kategori)
	{
		$this->javascript = array(
				config_item('metrolab_jquery'),
				config_item('metrolab_nicescroll'),
				config_item('metrolab_bootstrap_min_js'),
				config_item('metrolab_bootstrap_common'),
				config_item('metrolab_bootstrap_form-wizard-min'),
				config_item('metrolab_bootstrap_form-wizard'),
				config_item('metrolab_bootstrap_jsgritter'),
				config_item('metrolab_bootstrap_jspulstate'),
				config_item('metrolab_bootstrap_gritter'),
				config_item('metrolab_bootstrap_pulstate'),				
				config_item('metrolab_bootstrap_fileuploads'),
				config_item('metrolab_bootstrap_jQueryTagsInputJs'),
				config_item('ckeditor'),
				config_item('admin_berita_widget')
		);
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Add Berita - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$view['id']			= $kategori;
		$view['widget']		= $this->beritamodel->getwidgetname($kategori);
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_berita/add_widget',$view);
		}
		
	}
	
	function saveAddWidget()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			if($this->input->post("submit"))
			{
				$this->load->library("form_validation");
				$this->form_validation->set_rules('isi_berita', 'News', 'trim|required|min_length[24]|xss_clean');
				$this->form_validation->set_rules('judul', 'Title', 'trim|required');
				$this->form_validation->set_rules('id_kategori', 'Category', 'trim|required');
				$this->form_validation->set_rules('tags', 'Tag', 'trim');
			
				if($this->form_validation->run() == TRUE)
				{
					$holdOn 	 = "";
					$change		 = str_replace("|",",",$this->input->post("tags"));
					$holdTags 	 = explode("|",$this->input->post("tags"));
					for($i = 0;$i<count($holdTags);$i++)
					{
						if(substr($holdTags[$i],0,1) != "#")
						{
							$holdTags[$i] =  "#".$holdTags[$i];
							$holdOn 	  = $holdOn.",".$holdTags[$i];
						}
					}
					$judulSEO 	= str_replace(" ","-",$this->input->post("judul"));
					$judulSEO 	= $judulSEO . ".html";
					unset($holdTags);
					/*
					--------------------------
					|	Preparing Date Insert
					--------------------------
					*/
					$NamaHari	= array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
					$hari		= date("w");
					$prepareData = array(
						"username"	=> $this->session->userdata("username"),
						"judul"		=> $this->input->post("judul"),
						"id_kategori" => $this->input->post("id_kategori"),
						"judul_seo"	=> $judulSEO,
						"headline"	=> "Y",
						"isi_berita"=> str_replace("&nbsp;"," ",$this->input->post("isi_berita")),
						"hari"		=> $NamaHari[$hari],
						"tanggal"	=> date("Y-m-d"),
						"jam"		=> date("H:i:s"),
						"tag"		=> ltrim($holdOn,","),
						"gambar"	=> $this->input->post("gambar")
					);
					
					$data = $this->beritamodel->insertberita($prepareData);
					if($data)
					{
						$f["success"] = "Add News Success!!";
					}
					else
					{
						$f["failure"] 	= "Add News Failed, Check your internet connection!!";
					}
				}
				else
				{
					if(validation_errors('isi_berita')!=NULL)
					{
						$f['error_isi_berita'] = strip_tags(form_error('isi_berita'));
					}
					if(validation_errors('judul')!=NULL)
					{
						$f['error_judul'] = strip_tags(form_error('judul'));
					}
					if(validation_errors('tags')!=NULL)
					{
						$f['error_tags'] = strip_tags(form_error('tags'));
					}
					if(validation_errors('id_kategori')!=NULL)
					{
						$f['error_kategori'] = strip_tags(form_error('id_kategori'));
					}
				}
				echo json_encode($f);

			}
		
		}
	}
	
	function loadkategori()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view("content/kategori/loadkategori");
		}
	}
	
	function getkategori()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$data = $this->beritamodel->loadkategori();
			if($data && is_array($data))
			{
				echo json_encode($data);
			}
		}
	}
	
	function actionkategori($action,$id="")
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			if($action == "edit" && isset($id) && intval($id))
			{
				$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
				$view['title']		= "Manage Kategori Berita - Philtyphil";
				$view['javascript'] = $this->javascript;
				$view['css']		= $this->css;
				$view['function']	= $this->router->fetch_class();
				$view['data']		= $this->beritamodel->getEditKategori($id);
				$this->load->view("admin/manage_berita/editkategori",$view);
			}
			/** Jika actionnya add **/
			if($action == "add")
			{
			
			}
		}
	}
	
	function saveberitakategori()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			
			if($this->input->post("submit"))
			{
				$this->load->library("form_validation");
				$this->form_validation->set_rules('id_kategori', 'Kategori ', 'trim|required|numeric|xss_clean');
				$this->form_validation->set_rules('nama_kategori', 'Nama Kategori ', 'trim|required|xss_clean');
				$this->form_validation->set_rules('nama_kategori_seo', 'Nama Kategori SEO', 'trim|required|xss_clean');
				$this->form_validation->set_rules('aktif', 'aktif', 'trim|required|max_length[1]|xss_clean');
				$this->form_validation->set_rules('action', 'action', 'trim|required|xss_clean');
			
				if($this->form_validation->run() == TRUE)
				{
					if($this->input->post("action") == "edit")
					{
						$update = array("nama_kategori" => $this->input->post("nama_kategori"),
								"kategori_seo" => preg_replace('/[^a-zA-Z0-9\']/', '-', $this->input->post("nama_kategori_seo")),
								"aktif"		=> $this->input->post("aktif")
								);
						$update = $this->beritamodel->updateeditkategori($update,$this->input->post("id_kategori"));
						if($update)
						{
							$data["success"] = "Success!!";
							echo json_encode($data);
						}
						else
						{
							$data["failed"] = "Failed!!";
							echo json_encode($data);
						}
					}
					elseif($this->input->post("action")	== "add")
					{
					
					}
					else
					{
					
					}
				}
				else
				{
					if(validation_errors('id_kategori')!=NULL)
					{
						$data['error_id_kategori'] = strip_tags(form_error('id_kategori'));
					}
					if(validation_errors('nama_kategori')!=NULL)
					{
						$data['error_nama_kategori'] = strip_tags(form_error('nama_kategori'));
					}
					if(validation_errors('nama_kategori_seo')!=NULL)
					{
						$data['error_nama_kategori_seo'] = strip_tags(form_error('nama_kategori_seo'));
					}
					if(validation_errors('aktif')!=NULL)
					{
						$data['error_aktif'] = strip_tags(form_error('aktif'));
					}
					echo json_encode($data);
				}
			}
			
			function deletekategori()
			{
				if($this->input->post("submit"))
				{
					$this->load->library("form_validation");
					$this->form_validation->set_rules('id', 'ID ', 'trim|required|numeric|xss_clean');
				}
				
				if($this->form_validation->run() == TRUE)
				{
					$data = $this->beritamodel->deletekategori($this->input->post("id"));
					if($data)
					{
						unset($data);
						$data["success"] = "SUCCESS!!";
					}
				}
				else
				{
					$data["FAILED"] = "FAILED!!";
				}
				
				echo json_encode($data);
				
			}
		}
	}
	
}

/* End of file berita.php */
/* Location: ./application/controllers/berita.php */