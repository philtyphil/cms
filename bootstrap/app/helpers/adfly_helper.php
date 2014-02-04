<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('adfly'))
{
	function adfly($url, $key, $uid, $domain = 'adf.ly', $advert_type = 'int')
	{
	// base api url
	$api = 'http://api.adf.ly/api.php?';
	
	// api queries
	$query = array(
		'key' => $key,
		'uid' => $uid,
		'advert_type' => $advert_type,
		'domain' => $domain,
		'url' => $url
	);
	
	// full api url with query string
	$api = $api . http_build_query($query);
	if ($data = file_get_contents($api))
		return $data;
	}
}