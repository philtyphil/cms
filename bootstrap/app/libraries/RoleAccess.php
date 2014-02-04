<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed - philtyphil');

class RoleAccess
{
	function RoleAccess(){
      
	}
	function doLogin($username,$password,$remember = false)
	{
		$CI =& get_instance();
		$CI->load->Model('loginmodel');
		$check = $CI->loginmodel->doLogin($username,$password);
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
			$check = $CI->menuadminmodel->getrole($role,$menu);
			if(is_array($check) && $check->num_rows > 0)
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


