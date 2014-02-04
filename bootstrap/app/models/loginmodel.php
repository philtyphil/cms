<?php
class Loginmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function doLogin($username,$password)
	{
	
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		$this->db->limit('1');
		$this->db->select('*');
		$this->db->from('users');
		$data = $this->db->get()->result_array();
		return $data;
	}
	
	
}
?>