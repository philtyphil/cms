<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('googleurl'))
{
	function googleurl($url)
	{
		$apikey = 'AIzaSyADtueprdLXNi7tYf7RwMq5pxp2Ip_ANq0';
		$asset = array('longUrl' => $url, 'key' => $apikey);
		$object = json_encode($asset);
		$google = 'https://www.googleapis.com/urlshortener/v1/url';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $google);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $object);
		$data = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($data);
		$resulturl = $response->id;
		return $resulturl;
	}
}
?>