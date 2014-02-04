<?php
class Dashboardmodel extends CI_Model{
	private $db;
	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	
	function getkomen()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->limit("5");
			$this->db->select("komentar.nama_komentar,komentar.isi_komentar,komentar.tgl,komentar.jam_komentar,berita.judul");
			$this->db->from("komentar");
			$this->db->join("berita",'berita.id_berita=komentar.id_berita');
			$this->db->where("komentar.aktif",'Y');
			$data = $this->db->get();
			if($data->num_rows > 0)
			{
				return $data->result_array();
			}
			else
			{
				return false;
			}
		}
		
	}
	
	function gettop5site()
	{
		if($this->session->userdata("logged"))
		{
			$this->db->limit("5");
			$this->db->select("judul,dibaca");
			$this->db->from("berita");
			$this->db->order_by("dibaca","desc");
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
}
?>