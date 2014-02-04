<?php
class Notificationmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function save($r)
	{
		$data = $this->db->truncate("sekilasinfo");
		$insert = array(
			"info"			=> $r["notification"],
			"tgl_posting"	=> date("Y-m-d")
			);
		$data = $this->db->insert("sekilasinfo",$insert);
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