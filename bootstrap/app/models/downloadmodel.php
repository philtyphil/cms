<?php
class Downloadmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function save($r,$url)
	{
		$insert = array(
			"judul"			=> $r["tittle_download"],
			"nama_pengupload"	=> $this->session->userdata("username"),
			"tgl_posting"	=> date("Y-m-d"),
			"hits"			=> 0,
			"link"			=> $url
		);
		
		$data = $this->db->insert("download",$insert);
		if($data)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}
	
}
?>