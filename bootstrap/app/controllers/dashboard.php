<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('dashboardmodel');
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
			
		);
		
		$this->javascript = array(
			config_item('metrolab_jquery'),
			config_item('metrolab_nicescroll'),
			config_item('metrolab_bootstrap_min_js'),
			config_item('metrolab_bootstrap_jqueryflotjs'),
			config_item('metrolab_bootstrap_jqueryflotresizejs'),
			config_item('metrolab_bootstrap_jqueryflotpiejs'),
			config_item('metrolab_bootstrap_jqueryflotpiejs'),
			config_item('metrolab_bootstrap_jqueryflotstackjs'),
			config_item('metrolab_bootstrap_jqueryflotcrosshairjs'),
			config_item('metrolab_bootstrap_common'),
			//config_item('metrolab_bootstrap_flotcharjs'),
			config_item('metrolab_bootstrap_customflotcharjs'),
			config_item('admin_dash')
		);
		
	}
	public function index()
	{
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Admin Dashboard";
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['komentar']	= $this->dashboardmodel->getkomen();
		$view['top5site']	= $this->dashboardmodel->gettop5site();
		if($this->session->userdata("logged"))
		{
			$this->load->view('admin/manage_dash/admin_dash_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		} 	
	}
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */