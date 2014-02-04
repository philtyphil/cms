<!DOCTYPE html>
<html lang="en">
  <head>
	<meta name="author" content="philtyphils">
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title; ?></title>
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<?php
		if(isset($css) && is_array($css) && count($css) > 0){
			foreach($css as $link){
				$css = 'href='.config_item('base_url').$link['href'].' ';
				if(isset($link['rel'])) 
						$css .= 'rel = '.$link['rel'].' ';
				if(isset($link['type']))		
						$css .= 'type = '.$link['type'].' ';
				
				if(isset($link['media'])) 
					$css .= 'media = '.$link['media'];
				
				echo "<link $css>";	
			}
		}
		
		
	?>
	
  </head>

  <body>

    <div class="container">
		<div id="notifikasi">
		<?php 
		if(!empty($error))
		{
			echo '<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$error.'</div>';
		}
		if(!empty($error_username))
		{
			echo '<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$error_username.'</div>';
		}
		if(!empty($error_password))
		{
			echo '<div class="alert alert-danger text-center"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$error_password.'</div>';
		}
		?>
		</div>
		<form class="form-signin" action="<?php echo config_item('base_url');?>login/check" method="POST">
			<h2 class="form-signin-heading">Please sign in</h2>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			<button class="btn btn-lg btn-warning btn-block" onclick="window.location.href='<?php echo config_item("base_url")."register";?>'">Create New Account</button>
		</form>

    </div> <!-- /container -->

	
	<!-- Javascript place -->
	<?php
		if(isset($javascript) && is_array($javascript) && count($javascript) > 0){
			foreach($javascript as $js)
			{
				echo "<script src='".config_item('base_url').$js."'></script>";	
			}
		}	
	?>
	<!-- End of javascript -->
  </body>
</html>
