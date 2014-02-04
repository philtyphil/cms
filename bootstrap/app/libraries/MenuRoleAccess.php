<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed - philtyphil');

class MenuRoleAccess
{
	function __construct()
	{
		
	}
	
	function checkAccessMenu($role)
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
	
	function checkSubMenu($role,$idmain)
	{
		$CI =& get_instance();
		$CI->load->Model('menuadminmodel');
		$check = $CI->menuadminmodel->getsubmenu($role,$idmain);
		if(is_array($check) && count($check) > 0)
		{
			return $check;
		}
		else
		{
			return false;
		}
	}
	
	function checkAccess($session,$roleid,$menu)
	{
		
		if($session)
		{
			$CI =& get_instance();
			$CI->load->Model('menuadminmodel');
			$check = $CI->menuadminmodel->getrole($roleid,$menu);
			if($check->num_rows > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}


