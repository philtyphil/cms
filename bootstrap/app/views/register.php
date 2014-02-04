<!DOCTYPE html>
<html lang="en">
    <head>
    <meta name="author" content="philtyphils">
    <meta charset="utf-8">  
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Content Managament System Of Philtyphil">
    <meta name="author" content="philtyphil">

    <title><?php echo $title; ?></title>
   
	<?php
            
		echo $url_js;
		if(isset($css) && is_array($css) && count($css) > 0){
			foreach($css as $link){
				$css = 'href= '.config_item('base_url').$link['href'].' ';
				if(isset($link['rel'])) 
						$css .= 'rel = '.$link["rel"].' ';
				if(isset($link['type']))		
						$css .= 'type = '.$link['type'].' ';
				if(isset($link['media'])) 
					$css .= 'media = '.$link['media'];
				
				echo "<link $css>";	
			}
		}
		
		
	?>

	</head>
	<style>
	#loading {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%; 
		height: 100%;
		z-index: 9999;
		background: url(<?php echo  config_item('base_url')."public/images/default/logo2.png";?>) 50% 50% no-repeat white;
	}
	#main-content {
    margin-top: 0px;
    min-height: 1000px;
    background: #333;
	margin-left:0px;
    margin-bottom: 40px !important;
	}
	#pleasewait {
		position: fixed;
		left: 0px;
		top: 60%;
		width: 100%; 
		height: 100%;
		z-index: 9999;
	}
	</style>
	<body>
	<div id="loading" class="text-center"><div class="text-info" id="pleasewait" style="margin:auto 0;">Please Wait...</div></div>
	 <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                     Register Account
                   </h3>
                  <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
             <div class="row-fluid">
                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget black">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> Invoice Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                             <div class="row-fluid">
                                 <div class="span12">
                                     <div class="text-center">
                                         <img alt="" src="<?php echo config_item('base_url')."public/images/default/logo2.png";?>">
                                     </div>
                                     <hr>

                                 </div>
                             </div>
                             <div class="space20"></div>
                             <div class="row-fluid invoice-list">
							 <div class="alert alert-block alert-error fade in" id="alert_error" style="display:none;">
								<button class="close" type="button" data-dismiss="alert">&#215;</button>
								<h4 class="alert-heading">Error!</h4>
								<p id="error"> Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. </p>
							</div>
							<!-- End Of Notification Error -->
							<!-- Begin Notification Success-->
							<div class="alert alert-block alert-info" id="alert_success" style="display:none;">
								<button class="close" type="button" data-dismiss="alert">&#215;</button>
								<h4 class="alert-heading">Success!</h4>
								<p id="success"> Your Account Has Been Saved. Wait until We Approve Your Account. Thank you!!</p>
							</div>
							<!-- End of Notification Success-->
                                 <form class="form-horizontal" action="#">
                                <div id="pills" class="custom-wizard-pills">
                                 <ul>
                                     <li><a href="#pills-tab1" data-toggle="tab">Step 1</a></li>
                                     <li><a href="#pills-tab2" data-toggle="tab">Step 2</a></li>
                                     <li><a href="#pills-tab3" data-toggle="tab">Step 3</a></li>
                                     <li><a href="#pills-tab4" data-toggle="tab">Step 4</a></li>
                                 </ul>
                                 <div class="progress progress-success progress-striped active">
                                     <div class="bar"></div>
                                 </div>
                                 <div class="tab-content">
                                     <div class="tab-pane" id="pills-tab1">
                                         <h3>Fill up step 1 - Your Set ID</h3>
                                         <div class="control-group">
                                             <label class="control-label">Username<span style="color:red;">*</span></label>
                                             <div class="controls">
                                                 <input id="username" type="text" class="span6" value="" onKeyup="usernamechange(this.value)">
                                                 <span class="help-inline">Give your username</span>
                                             </div>
                                         </div>
										 <div class="control-group">
                                             <label class="control-label">Password<span style="color:red;">*</span></label>
                                             <div class="controls">
                                                 <input id="password" type="password" class="span6" value="">
                                                 <span class="help-inline">Give your password</span>
                                             </div>
                                         </div>
                                         <div class="control-group">
                                             <label class="control-label">Email</label>
                                             <div class="controls">
                                                 <input id="email" type="email" class="span6" onkeyup="emailchange(this.value)">
                                                 <span class="help-inline">Give your Email</span>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="tab-pane" id="pills-tab2">
                                         <h3>Fill up step 2 - Your Profil</h3>
                                         <div class="control-group">
                                             <label class="control-label">Full Name</label>
                                             <div class="controls">
                                                 <input id="nama_lengkap" type="text" class="span6" />
                                                 <span class="help-inline">Give your First Name</span>
                                             </div>
                                         </div>
                                         
                                         <div class="control-group">
                                             <label class="control-label">Phone Number</label>
                                             <div class="controls">
                                                 <input type="text" id="no_tlp" class="span6" onKeyup="phonechange(this.value)" />
                                                 <span class="help-inline">Give your phone number</span>
                                             </div>
                                         </div>
										  <div class="control-group">
										<label class="control-label">Photo Upload</label>
										<div class="controls">
											<div data-provides="fileupload" class="fileupload fileupload-new">
												<div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
													<img alt="" src="<?php echo config_item('base_url')."public/images/default/AAAAAA&text=no+image.gif";?>">
												</div>
												<div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
												<div>
												<span class="btn btn-file"><span class="fileupload-new">Select image</span>
												<span class="fileupload-exists">Change</span>
												<input type="file" class="default" id="photoImg"></span>
													<a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
												</div>
											</div>
											<span class="label label-important">NOTE!</span>
											<span>
											Best View 210x160 Pixels
											</span>
										</div>
                                </div>
                                     </div>
                                     <div class="tab-pane" id="pills-tab3">
                                         <h3>Fill up step 3 - Your Social Media</h3>
                                         <div class="control-group">
                                             <label class="control-label">Facebook Link</label>
                                             <div class="controls">
                                                 <input id="facebook" type="text" class="span6" />
                                                 <span class="help-inline"></span>
                                             </div>
                                         </div>
										 
										 <div class="control-group">
                                             <label class="control-label">Twitter Link</label>
                                             <div class="controls">
                                                 <input id="twitter" type="text" class="span6" />
                                                 <span class="help-inline"></span>
                                             </div>
                                         </div>
										 
										 <div class="control-group">
                                             <label class="control-label">LinkedIn Link </label>
                                             <div class="controls">
                                                 <input id="linkedin" type="text" class="span6" />
                                                 <span class="help-inline"></span>
                                             </div>
                                         </div>
										 
										 <div class="control-group">
                                             <label class="control-label">Google+ Link </label>
                                             <div class="controls">
                                                 <input id="googleplus" type="text" class="span6" />
                                                 <span class="help-inline"></span>
                                             </div>
                                         </div>
										
                                     </div>
                                     <div class="tab-pane" id="pills-tab4">
                                         <h3>Final step</h3>
                                         <div class="control-group">
                                             <label class="control-label">Fullname:</label>
                                             <div class="controls">
                                                 <span class="text" id="name_final"></span>
                                             </div>
                                         </div>
                                         <div class="control-group">
                                             <label class="control-label">Email:</label>
                                             <div class="controls">
                                                 <span class="text" id="email_final"></span>
                                             </div>
                                         </div>
                                         <div class="control-group">
                                             <label class="control-label">Phone:</label>
                                             <div class="controls">
                                                 <span class="text" id="phone_final"></span>
                                             </div>
                                         </div>
                                         <div class="control-group">
                                             <label class="control-label"></label>
                                             <div class="controls">
                                                 <label class="checkbox">
                                                     <input type="checkbox" id="confirm" value="submit" /> I confirm my steps
                                                 </label>
                                             </div>
                                         </div>
                                     </div>
                                     <ul class="pager wizard">
                                         <li class="previous first"><a href="javascript:;">First</a></li>
                                         <li class="previous"><a href="javascript:;">Previous</a></li>
                                         <li class="next last"><a href="javascript:;">Last</a></li>
                                         <li class="next"><a  href="javascript:;">Next</a></li>
                                     </ul>
                                 </div>
                             </div>
                             </form>
                        
                             </div>
                             <div class="space20"></div>
                             <div class="space20"></div>
                            
                             <div class="space20"></div>
                             <div class="row-fluid text-center">
                                 <a class="btn btn-success btn-large hidden-print" onclick="javascript:reg();"> Register <i class="icon-check"></i></a>
                             </div>
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
             </div>
            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
	<div id="footer">
       2013 &copy; CMS Philtyphil Philantrophist
   </div> 
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