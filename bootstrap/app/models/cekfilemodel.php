<?php
class Cekfilemodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	function cekfile($name,$id)
	{
		$this->db->where("id_berita",intval($id));
		$this->db->where("gambar",$name);
		$this->db->from("berita");
		$this->db->select("gambar");
		$data = $this->db->get();
		if($data->num_rows() > 0)
		{
			return $data->result_array();
			
		}
		else
		{
			return false;
		}
	}
}
?>