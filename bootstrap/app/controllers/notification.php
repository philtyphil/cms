<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	function __construct()
	{
		
		parent::__construct();
		$this->load->helper('url');$this->load->model('notificationmodel');$this->load->library('session');
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
			config_item('metrolab_bootstrap_choosen_css')
			
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
			config_item('admin_notification')
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
			$this->load->view('admin/manage_notification/notification_view',$view);
		}
		else
		{
			redirect(config_item('base_url').'login', 'refresh');
		}
	}
	
	function save()
	{
		if($this->session->userdata("logged"))
		{
			$this->load->library('form_validation');
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('notification', 'Notification', 'trim|required|min_length[3]|xss_clean');
				
				if($this->form_validation->run() == TRUE)
				{
					$data = $this->notificationmodel->save($this->input->post());
					if($data)
					{
						unset($data);
						$data["success"] = "OK!!!";
					}
					else
					{
						unset($data);
						$data["failed"]	= "failed";
					}
					echo json_encode($data);
				}
				else
				{
					if(validation_errors('notification')!=NULL){
						$view['error_notification'] = strip_tags(form_error('notification'));
					}
					echo json_encode($view);
					
				}
				
				
			}
		}
		
	}
	
}

/* End of file menu.php */
/* Location: ./application/controllers/menu.php */