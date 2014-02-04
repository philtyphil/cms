<?php
class Registermodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function save($r)
	{
		$insert = array(
			"username"		=> $r["username"],		// username
			"password"		=> $r["password"],		// password
			"nama_lengkap"	=> $r["nama_lengkap"],	// nama lengkap
			"email"			=> $r["email"],			// email
			"no_telp"		=> $r["no_telp"],		// nomor telpon
			"blokir"		=> "Y",					// status blokir (default: Y)
			"role_id"		=> "2",					// Role ID ( 2 = user)
			"facebook"		=> $r["facebook"],		// link facebook
			"twitter"		=> $r["twitter"],
			"linkedin"		=> $r["linkedin"],
			"googleplus"	=> $r["googleplus"],
			"gambar"		=> $r["img"],
			"tgl_insert"	=> date("Y-m-d")
		);
		$data = $this->db->insert("users",$insert);
		if($data)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function usernameCheck($str)
	{
		$this->db->where("username",$str);
		$this->db->select("username");
		$this->db->from("users");
		$this->db->limit("1");
		$data = $this->db->get();
		if($data->num_rows > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	
}
?>