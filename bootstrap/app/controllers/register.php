<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('registermodel');
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
			config_item('metrolab_bootstrap_clockface')
			
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
			config_item('metrolab_bootstrap_form-wizard-min'),
			config_item('metrolab_bootstrap_form-wizard'),			
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_jQueryTagsInputJs'),
			config_item('metrolab_bootstrap_fileuploads'),
			config_item('register')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Berita - Philtyphil";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		$this->load->view('register',$view);
	}
	
	function save()
	{
		$this->load->library('form_validation');
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numuric|callback_username_check');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|md5|xss_clean');
			$this->form_validation->set_rules('nama_lengkap', 'Full Name', 'trim|required');
			$this->form_validation->set_rules('no_telp', 'Phone Numbwer', 'trim|required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('facebook', 'Facebook Link', 'trim|prep_url');
			$this->form_validation->set_rules('twitter', 'Twitter Link', 'trim|prep_url');
			$this->form_validation->set_rules('img', 'Image Upload', 'trim|required|xss_clean');
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
				if(validation_errors('nama_lengkap')!=NULL){
					$view['error_nama_lengkap'] = strip_tags(form_error('nama_lengkap'));
				}
				if(validation_errors('facebook')!=NULL){
					$view['error_facebook'] = strip_tags(form_error('facebook'));
				}
				if(validation_errors('twiiter')!=NULL){
					$view['error_twiiter'] = strip_tags(form_error('twiiter'));
				}
				if(validation_errors('linkedin')!=NULL){
					$view['error_linkedin'] = strip_tags(form_error('linkedin'));
				}
				if(validation_errors('googleplus')!=NULL){
					$view['error_googleplus'] = strip_tags(form_error('googleplus'));
				}
				if(validation_errors('img')!=NULL){
					$view['error_img'] = strip_tags(form_error('img'));
				}
			}
			else
			{
				$data = $this->registermodel->save($this->input->post());
				if($data)
				{
					
					$view['notif'] = "Register Success";
				}
				
			}
			echo json_encode($view);
		}
	}
	
	function uploadImage()
	{
		$this->load->helper("img");
		/** img(filenya,width,height,filename) - Helper Added By Philtyphil A.K.A Sulisto Nur Anggoro @philtyphils**/ 
		img($_FILES,"200","150","imgprofil");
		return false;
		
	}
	
	function username_check($str)
	{
		$data = $this->registermodel->usernameCheck($str);
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
	
}

/* End of file berita.php */
/* Location: ./application/controllers/berita.php */