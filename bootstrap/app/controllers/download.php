<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');$this->load->model('downloadmodel');$this->load->library('session');
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
			config_item('metrolab_bootstrap_fileuploads'),
			config_item('admin_download')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Dashboard - Saung Bekasi Utara";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_download/download_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function save()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->library('form_validation');
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('tittle_download', 'Title', 'trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('url', 'Link Url', 'trim|required|xss_clean|prep_url');
				
				if($this->form_validation->run() == TRUE)
				{
					$this->load->helper("adfly");
					$key 	= "38f7042b18eaf78f2fea7483844b3603";
					$uid	= "68435";
					$url = adfly($this->input->post("url"),$key,$uid);
					if($url == "Sorry but there are some temporary host problems. Please try again later.")
					{
						$this->load->helper("googleurl");
						$url = googleurl($this->input->post("url"));
						if(empty($url) || $url == false)
						{
							$url = $this->input->post("url");
						}
					}
					$data= $this->downloadmodel->save($this->input->post(),$url);
					if($data)
					{
						$view["success"] = "Success!!";
					}
					else
					{
						$view["failed"] = "Something wrong, add download file is failed";
					}
				}
				else
				{
					if(validation_errors('tittle_download')!=NULL){
						$view['error_tittle_download'] = strip_tags(form_error('tittle_download'));
					}
					if(validation_errors('url')!=NULL){
						$view['error_url'] = strip_tags(form_error('url'));
					}
				}
				echo json_encode($view);
				
			}
		}
		
	}
	
}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */