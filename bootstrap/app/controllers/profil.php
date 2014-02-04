<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('profilmodel');
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
			config_item('metrolab_bootstrap_wysihtml5'),
			config_item('metrolab_bootstrap_clockface')
			
		);
		
		$this->javascript = array(
			config_item('metrolab_jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_datatables'),
			config_item('metrolab_bootstrap_DT'),
			config_item('metrolab_bootstrap_dynamic'),
			config_item('metrolab_bootstrap_toggle'),
			config_item('metrolab_bootstrap_fancyboxs'),
			config_item('metrolab_bootstrap_jQueryTagsInputJs'),
			config_item('metrolab_bootstrap_uniform'),
			config_item('metrolab_bootstrap_choosen'),
			config_item('metrolab_bootstrap_wysihtml5-0.3.0'),
			config_item('metrolab_bootstrap_wysihtml5_js'),
			config_item('metrolab_bootstrap_clockfaces'),
			config_item('metrolab_bootstrap_bootstrap-datepicker'),
			config_item('metrolab_bootstrap_bootstrap_date'),
			config_item('metrolab_bootstrap_daterangepicker'),
			config_item('metrolab_bootstrap_timepicker'),
			config_item('metrolab_bootstrap_colorpicker'),
			config_item('metrolab_bootstrap_common'),
			config_item('metrolab_bootstrap_form-component'),
			config_item('metrolab_bootstrap_jspulstate'),
			config_item('metrolab_bootstrap_pulstate'),
			config_item('profil')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Manage Berita - Saung Bekasi Utara";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['function']	= $this->router->fetch_class();
		
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->view('admin/manage_profil/admin_profil',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		} 	
	}
	
	function getdesc()
	{
		$data	= $this->profilmodel->getdesc();
		echo json_encode($data);
	}
	
	function save()
	{
		$this->load->library("MenuRoleAccess");
		if($this->menuroleaccess->checkAccess($this->session->userdata("logged"),$this->session->userdata("role_id"),$this->router->fetch_class()))
		{
			$this->load->library('form_validation');
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('desc', 'Description ', 'xss_clean');
				
				if($this->form_validation->run() == FALSE)
				{
					if(validation_errors('desc')!=NULL){
						$view['error_desc'] = strip_tags(form_error('desc'));
					}
					
				}
				else
				{
					$insert = array(
						"isi_halaman" 	=> $this->input->post("desc"),
						"tgl_posting" 	=> date("Y-m-d"),
						"last_update"	=> $this->session->userdata("username")
					);
					$data = $this->profilmodel->insertdesc($insert);
					if($data)
					{
						$view["notif"] = "Update Description Successfull!!";
					}
				}
				echo json_encode($view);
			}
		}
	}
	
	
	
}

/* End of file berita.php */
/* Location: ./application/controllers/berita.php */