<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed - philtyphil');

class Cekphotoexist
{
	function __construct()
	{
		
	}
	
	function cekfile($role)
	{
		$CI =& get_instance();
		$CI->load->Model('menuadminmodel');
		$check = $CI->menuadminmodel->getmenu($role);
		if(is_array($check) && count($check) > 0)
		{
			return $check;
		}
		else
		{
			return false;
		}
		
	}
	
	private function cekFileFoto($name,$id)
	{
		$CI =& get_instance();
		$CI->load->Model('cekfilemodel');
		$data = $CI->cekfilemodel->cekfile($name,$id);
		if(!$data)
		{
			$data = $data->result_array();
			unlink("public/images/img_uploaded/imgBW_".$data[0]["gambar"]);
			unlink("public/images/img_uploaded/beritaheader_".$data[0]["gambar"]);
			unlink("public/images/img_uploaded/singlepost_".$data[0]["gambar"]);
		}
		return false;
	}
}


