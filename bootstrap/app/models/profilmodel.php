<?php
class Profilmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function getdesc()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("id_halaman",'1');
			$this->db->limit("1");
			$this->db->select("id_halaman,isi_halaman");
			$this->db->from("halamanstatis");
			$data = $this->db->get();
			if($data->num_rows() > 0)
			{
				return $data->result_array();
			}
			else
			{
				return array();
			}
		}
	}
	
	function insertdesc($insert)
	{
		if($this->session->userdata("logged"))
		{
			$this->db->where("id_halaman","1");
			$data = $this->db->update("halamanstatis",$insert);
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
}
?>