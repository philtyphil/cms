<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('blogmodel');
		$this->css = array(
			config_item('abbu_style'),
			config_item('abbu_style-responsive'),
			config_item('abbu_override'),
			config_item('abbu_sequence'),
			config_item('abbu_ribbons'), 
			config_item('abbu_colors')
			
		);
		
		$this->javascript = array(
			config_item('abbu_jQueryJS'),
			config_item('abbu_modernizr'),
			config_item('abbu_flexslider'),
			config_item('abbu_twitter'),
			config_item('abbu_fancybox'),
			config_item('abbu_isotope'),
			config_item('abbu_bootstrap'),
			config_item('abbu_fitvids'),
			config_item('abbu_custom'),
			config_item('abbu_datatables'),
			config_item('abbu_bootstrap_DT'),
			config_item('abbu_selectnav'),
			config_item('frontblog')
		);
		
	}
	public function index()
	{
		$this->load->model('mainmenumodel');
		$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Blog - ".config_item("base_url");
		$view['javascript']     = $this->javascript;
		$view['css']		= $this->css;
		$view['kategori']	= $this->blogmodel->getkategori();
                $view['mainmenu']       = $this->mainmenumodel->loadmainmenu();
                $this->load->library("Notification");
                $view['notification']   = $this->notification->notification();
		$this->load->view('blog/blogview',$view);
		
	}
	
	function getallblog()
	{
		$data = $this->blogmodel->sResultBlog();
		echo json_encode($data);
	}
	
	function kategori($id_kategori,$kategori = "")
	{
		$data = $this->blogmodel->sResult(intval($id_kategori),$kategori);
               
			$this->javascript = array(
			config_item('abbu_jQueryJS'),
			config_item('abbu_modernizr'),
			config_item('abbu_selectnav'),
			config_item('abbu_flexslider'),
			config_item('abbu_twitter'),
			config_item('abbu_fancybox'),
			config_item('abbu_isotope'),
			config_item('abbu_bootstrap'),
			config_item('abbu_fitvids'),
			config_item('abbu_custom'),
			config_item('abbu_datatables'),
			config_item('abbu_bootstrap_DT'),
			config_item('frontblogkategori')
			);
			$view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
			$view['title']		= "Blog - Kategori ". $kategori;
			$view['javascript'] = $this->javascript;
			$view['css']		= $this->css;
			$view['kategori']	= $this->blogmodel->getkategori();
                        $view['nama_kategori']  = $kategori;
			$view['data']		= $data;
                         $this->load->library("Notification");
                         $view['notification']   = $this->notification->notification();
			$this->load->view('blog/blog_kategori_view',$view);
		
	}
    
    function widget($id,$judul = null)
    {
		$this->javascript = array(
			config_item('abbu_jQueryJS'),
			config_item('abbu_modernizr'),
			config_item('abbu_selectnav'),
			config_item('abbu_flexslider'),
			config_item('abbu_twitter'),
			config_item('abbu_fancybox'),
			config_item('abbu_isotope'),
			config_item('abbu_bootstrap'),
			config_item('abbu_fitvids'),
			config_item('abbu_custom'),
			config_item('abbu_datatables'),
			config_item('abbu_bootstrap_DT'),
			config_item('blogwidget')
			);
        $view['url_js']		= "<script type='text/javascript'>var base_url='" . config_item('base_url') ."';</script>";
		$view['title']		= "Blog ".$judul." - ".config_item("base_url");
		$view['javascript'] = $this->javascript;
		$view['css']		= $this->css;
		$view['data']	    = $this->blogmodel->sResult($id);
                $view['kategori']   = $this->blogmodel->getkategori();
                $this->load->library("Notification");
                $view['notification']   = $this->notification->notification();
		$this->load->view('blog/blogwidget',$view);
    }
	
	function blogpost($id,$judul = null)
	{
           
            $this->javascript = array(
            config_item('abbu_jQueryJS'),
            config_item('abbu_modernizr'),
            config_item('abbu_selectnav'),
            config_item('abbu_twitter'),
            config_item('abbu_fancybox'),
            config_item('abbu_isotope'),
            config_item('abbu_bootstrap'),
            config_item('abbu_fitvids'),
            config_item('abbu_custom'),
            config_item('abbu_datatables'),
            config_item('abbu_bootstrap_DT'),
            config_item('blogpost')
             );
            $view['url_js'] = "<script type='text/javascript'>var base_url='" . config_item('base_url') . "';</script>";
            $view['title'] = "Blog " . $judul . " - " . config_item("base_url");
            $view['javascript'] = $this->javascript;
            $view['css'] = $this->css;
            $view['data'] = $this->blogmodel->blogpost($id);
            $view['kategori'] = $this->blogmodel->getkategori();
            $view['komentar'] = $this->blogmodel->getkomentar($id);
			$this->load->library("Notification");
                $view['notification']   = $this->notification->notification();
            $this->load->view('blog/blogpost', $view);
        }
        
        function addcomment()
        {
            $this->load->library('form_validation');
            if ($this->input->post('submit')) {
                $this->form_validation->set_rules('id_berita', 'Something', 'trim|required');
                $this->form_validation->set_rules('nama_komentar', 'Username', 'trim|required|alpha_numeric');
                $this->form_validation->set_rules('isi_komentar', 'Comment', 'trim|required');

                if ($this->form_validation->run() == FALSE) {
                    if (validation_errors('id_berita') != NULL) {
                        $view['error_id_berita'] = strip_tags(form_error('id_berita'));
                    }
                    if (validation_errors('nama_komentar') != NULL) {
                        $view['error_nama_komentar'] = strip_tags(form_error('nama_komentar'));
                    }
                    if (validation_errors('isi_komentar') != NULL) {
                        $view['error_isi_komentar'] = strip_tags(form_error('isi_komentar'));
                    }
                } else {
                    $data = $this->blogmodel->addcomment($this->input->post());
                    if ($data) {
                        $view['notif'] = "Add Comment Success";
                    }
                }
                echo json_encode($view);
            }
    }
    
    function loadnewkomentar($id)
    {
        $view["komentar"] = $this->blogmodel->getkomentar($id);
        $this->load->view("content/newkomentar",$view);
    }
        
      
	
	
	
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */