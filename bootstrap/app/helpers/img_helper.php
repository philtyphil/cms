<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('img'))
{
	function img($file,$width,$height,$filename)
	{
		if($file['file-0']['error'] < 1 && !file_exists("public/images/img_uploaded/" . $file["file-0"]["name"]))
		{
			move_uploaded_file($file["file-0"]["tmp_name"], "public/images/img_uploaded/".str_replace(" ","-",$file["file-0"]["name"]));
			$image = imagecreatefromjpeg("public/images/img_uploaded/".str_replace(" ","-",$file["file-0"]["name"]));
			$filename = "public/images/img_uploaded/".$filename."_".str_replace(" ","-",$file["file-0"]["name"]);
			
			$thumb_width = $width;
			$thumb_height = $height;
			
			$width = imagesx($image);
			$height = imagesy($image);
			
			$original_aspect = $width / $height;
			$thumb_aspect = $thumb_width / $thumb_height;
			
			if ( $original_aspect >= $thumb_aspect )
			{
			// If image is wider than thumbnail (in aspect ratio sense)
			$new_height = $thumb_height;
			$new_width = $width / ($height / $thumb_height);
			}
			else
			{
			// If the thumbnail is wider than the image
			$new_width = $thumb_width;
			$new_height = $height / ($width / $thumb_width);
			}
			
			$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );
			
			// Resize and crop
			imagecopyresampled($thumb,
							$image,
							0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
							0 - ($new_height - $thumb_height) / 2, // Center the image vertically
							0, 0,
							$new_width, $new_height,
							$width, $height);
			$notif = imagejpeg($thumb, $filename, 80);
			
			unlink("public/images/img_uploaded/".str_replace(" ","-",$file["file-0"]["name"]));
		}
		if($notif)
		{
			return $notif;
		}
		else
		{
			return false;
		}
	}	
}




?>