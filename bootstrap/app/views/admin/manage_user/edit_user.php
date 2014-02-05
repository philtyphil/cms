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
	background: url(<?php echo config_item("base_url");?>public/images/default/loading.gif) 50% 50% no-repeat white;
}
	</style>
 
<body class="fixed-top">
   <!-- BEGIN HEADER  -->
	<div id="loading"></div>
     	   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner" style="background:none repeat scroll 0 0 #4A8BC2">
           <div class="container-fluid" style="background:none repeat scroll 0 0 #4A8BC2">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                   <div class="icon-reorder"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
             
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div id="top_menu" class="nav notify-row">
                   <!-- BEGIN NOTIFICATION -->
                   <ul class="nav top-menu">
                       <!-- BEGIN SETTINGS -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-tasks"></i>
                               <span class="badge badge-important">6</span>
                           </a>
                           <ul class="dropdown-menu extended tasks-bar">
                               <li>
                                   <p>You have 6 pending tasks</p>
                               </li>
                               <li>
                                   <a href="#">
                                       <div class="task-info">
                                         <div class="desc">Dashboard v1.3</div>
                                         <div class="percent">44%</div>
                                       </div>
                                       <div class="progress progress-striped active no-margin-bot">
                                           <div class="bar" style="width: 44%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <div class="task-info">
                                           <div class="desc">Database Update</div>
                                           <div class="percent">65%</div>
                                       </div>
                                       <div class="progress progress-striped progress-success active no-margin-bot">
                                           <div class="bar" style="width: 65%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <div class="task-info">
                                           <div class="desc">Iphone Development</div>
                                           <div class="percent">87%</div>
                                       </div>
                                       <div class="progress progress-striped progress-info active no-margin-bot">
                                           <div class="bar" style="width: 87%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <div class="task-info">
                                           <div class="desc">Mobile App</div>
                                           <div class="percent">33%</div>
                                       </div>
                                       <div class="progress progress-striped progress-warning active no-margin-bot">
                                           <div class="bar" style="width: 33%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <div class="task-info">
                                           <div class="desc">Dashboard v1.3</div>
                                           <div class="percent">90%</div>
                                       </div>
                                       <div class="progress progress-striped progress-danger active no-margin-bot">
                                           <div class="bar" style="width: 90%;"></div>
                                       </div>
                                   </a>
                               </li>
                               <li class="external">
                                   <a href="#">See All Tasks</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END SETTINGS -->
                       <!-- BEGIN INBOX DROPDOWN -->
                       <li class="dropdown" id="header_inbox_bar">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <i class="icon-envelope-alt"></i>
                               <span class="badge badge-important">5</span>
                           </a>
                           <ul class="dropdown-menu extended inbox">
                               <li>
                                   <p>You have 5 new messages</p>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="photo"><img src="img/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jonathan Smith</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, this is an example msg.
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="photo"><img src="img/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jhon Doe</span>
									<span class="time">10 mins</span>
									</span>
									<span class="message">
									 Hi, Jhon Doe Bhai how are you ?
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="photo"><img src="img/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jason Stathum</span>
									<span class="time">3 hrs</span>
									</span>
									<span class="message">
									    This is awesome dashboard.
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="photo"><img src="img/avatar-mini.png" alt="avatar" /></span>
									<span class="subject">
									<span class="from">Jondi Rose</span>
									<span class="time">Just now</span>
									</span>
									<span class="message">
									    Hello, this is metrolab
									</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">See all messages</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END INBOX DROPDOWN -->
                       <!-- BEGIN NOTIFICATION DROPDOWN -->
                       <li class="dropdown" id="header_notification_bar">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                               <i class="icon-bell-alt"></i>
                               <span class="badge badge-warning">7</span>
                           </a>
                           <ul class="dropdown-menu extended notification">
                               <li>
                                   <p>You have 7 new notifications</p>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="label label-important"><i class="icon-bolt"></i></span>
                                       Server #3 overloaded.
                                       <span class="small italic">34 mins</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="label label-warning"><i class="icon-bell"></i></span>
                                       Server #10 not respoding.
                                       <span class="small italic">1 Hours</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="label label-important"><i class="icon-bolt"></i></span>
                                       Database overloaded 24%.
                                       <span class="small italic">4 hrs</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="label label-success"><i class="icon-plus"></i></span>
                                       New user registered.
                                       <span class="small italic">Just now</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">
                                       <span class="label label-info"><i class="icon-bullhorn"></i></span>
                                       Application error.
                                       <span class="small italic">10 mins</span>
                                   </a>
                               </li>
                               <li>
                                   <a href="#">See all notifications</a>
                               </li>
                           </ul>
                       </li>
                       <!-- END NOTIFICATION DROPDOWN -->

                   </ul>
               </div>
               <!-- END  NOTIFICATION -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <!-- BEGIN SUPPORT -->
                       <li class="dropdown mtop5">

                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Chat">
                               <i class="icon-comments-alt"></i>
                           </a>
                       </li>
                       <li class="dropdown mtop5">
                           <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Help">
                               <i class="icon-headphones"></i>
                           </a>
                       </li>
                       <!-- END SUPPORT -->
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <img src="img/avatar1_small.jpg" alt="">
                               <span class="username"><?php echo ucfirst($this->session->userdata("username"));?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
								<li><a href="<?php echo config_item("base_url")."logout";?>"><i class="icon-key"></i> Log Out</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar-scroll">
          <div id="sidebar" class="nav-collapse collapse">

              <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
              <div class="navbar-inverse">
                  <form class="navbar-search visible-phone">
                      <input type="text" class="search-query" placeholder="Search" />
                  </form>
              </div>
              <!-- END RESPONSIVE QUICK SEARCH FORM -->
              <!-- BEGIN SIDEBAR MENU -->
              <ul class="sidebar-menu" id="loadmenu">
                
              </ul>
              <!-- END SIDEBAR MENU -->
          </div>
      </div>
      <!-- END SIDEBAR -->
      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                   
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                     Manage <?php echo $function; ?>  edit <a href="#"><i class="icon-reorder"></i></a>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo config_item('base_url');?>dashboard">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Manage <?php echo $function; ?> edit </a>
                          
                       </li>
                       
                       <li class="pull-right search-wrap">
                           <form action="#" class="hidden-phone">
                               <div class="input-append search-input-area">
                                   <input class="" id="appendedInputButton" type="text"/>
                                   <button class="btn" type="button"><i class="icon-search"></i> </button>
                               </div>
                           </form>
                       </li>
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
				
                <!-- Penambahan Widget Philtyphil -->
                    <div class="widget orange">
                        <div class="widget-title">
                        <h4><i class="icon-tasks"></i> <?php echo $function; ?> edit  </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <form action="#" class="form-horizontal" >
                               <div class="control-group " id="menu_edit_namalengkap">
                                     <label class="control-label" for="inputError">Nama Lengkap</label>
                                     <div class="controls">
                                         <input type="text" id="edit_namalengkap_user" class="span6 popovers" value="<?php echo $data[0]['nama_lengkap'];?>" data-trigger="hover" data-content="Edit To Change Name" data-original-title="Edit Name" required=""/>
                                         <span class="help-inline" id="error_namalengkap"></span>
                                     </div>
                                 </div>
                                <div class="control-group" id="menu_edit_username">
                                     <label class="control-label" for="inputError">Username</label>
                                     <div class="controls">
                                         <input type="text" id="edit_username_user" readonly="readonly" class="span6 popovers" value="<?php echo $data[0]['username'];?>" data-trigger="hover" data-content="You cant to change username" data-original-title="Disabled" required=""/>
                                         <span class="help-inline" id="error_username"></span>
                                     </div>
                                </div>
								 <div class="control-group" id="menu_edit_password">
                                     <label class="control-label" for="inputError">Password</label>
                                     <div class="controls">
                                         <input type="password" id="edit_password_user" class="span6 popovers" value="" data-trigger="hover" data-content="Insert Your Password" data-original-title="Insert Password" required=""/>
                                         <span class="help-inline" id="error_username"></span>
                                     </div>
                                </div>
								<div class="control-group">
                                    <label class="control-label">Image Upload</label>
                                    <div class="controls">
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
												<?php if(isset($data[0]['gambar'])): ?>
												<img alt="" src="<?php echo config_item('base_url')."public/images/img_uploaded/imgprofil_".$data[0]['gambar'];?>">
												<?php else: ?>
                                                <img alt="" src="<?php echo config_item('base_url')."public/images/default/AAAAAA&text=no+image.gif";?>">
												<?php endif; ?>
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
                                         
                                         </span>
                                    </div>
                                </div>
                                <div class="control-group" id="menu_edit_email">
                                     <label class="control-label" for="inputError">Email</label>
                                     <div class="controls">
                                         <input type="email" id="edit_email_user" class="span6 popovers" value="<?php echo $data[0]['email'];?>" data-trigger="hover" data-content="Insert Your Email Address" data-original-title="Insert Email" required=""/>
                                         <span class="help-inline" id="error_email"></span>
                                     </div>
                                 </div>
								 <div class="control-group" id="menu_edit_notelp">
                                     <label class="control-label" for="inputError">No Telp</label>
                                     <div class="controls">
                                         <input type="text" id="edit_notelp_user" class="span6 popovers" value="<?php echo $data[0]['no_telp'];?>" data-trigger="hover" data-content="Insert Phone Number" data-original-title="Insert Email" required=""/>
                                         <span class="help-inline" id="error_notelp"></span>
                                     </div>
                                 </div>
								 
								  <div class="control-group" id="menu_edit_icon">
                                     <label class="control-label" for="inputError">Blokir</label>
                                     <div class="controls">
                                        <?php if($data[0]["blokir"] == "Y"): ?>
											<input type="radio" name="edit_blokir" value="Y" checked> Yes
											<input type="radio" name="edit_blokir" value="N" > No
										<?php else: ?>
											<input type="radio" name="edit_blokir" value="Y"> Yes
											<input type="radio" name="edit_blokir" value="N" checked > No
										<?php endif; ?>
                                     </div>
                                 </div>
								<div class="control-group" id="menu_edit_blokir">
                                   <label class="control-label" for="inputError">Role id</label>
                                   <div class="controls">
									<select id="edit_level_user" class="chzn-select-deselect" data-placeholder="Choose a Role Id" tabindex="1">
									<option value="<?php echo $data[0]["role_id"] . " - " . $data[0]["level"];?>"><?php echo $data[0]["level"];?> </option>
									<?php foreach($role as $key => $v):?>
										<option value="<?php echo $v['id_group_access']." - ".$v['group'];?>"><?php echo $v['group']; ?></option>
									<?php endforeach; ?>
									</select>
								    </div>
                                </div>
								<div class="control-group" id="menu_edit_facebook">
                                     <label class="control-label" for="inputError">Facebook</label>
                                     <div class="controls">
                                         <input type="text" id="edit_facebook" class="span6 popovers" value="<?php echo $data[0]['facebook'];?>" data-trigger="hover" data-content="Facebook link" data-original-title="Facebook" required=""/>
                                         <span class="help-inline" id="error_facebook"></span>
                                     </div>
                                 </div>
								 <div class="control-group" id="menu_edit_twitter">
                                     <label class="control-label" for="inputError">Twitter</label>
                                     <div class="controls">
                                         <input type="text" id="edit_twitter" class="span6 popovers" value="<?php echo $data[0]['twitter'];?>" data-trigger="hover" data-content="Twitter link" data-original-title="Twitter" required=""/>
                                         <span class="help-inline" id="error_facebook"></span>
                                     </div>
                                 </div>
								 <div class="control-group" id="menu_edit_linkedin">
                                     <label class="control-label" for="inputError">Linkedin</label>
                                     <div class="controls">
                                         <input type="text" id="edit_linkedin" class="span6 popovers" value="<?php echo $data[0]['linkedin'];?>" data-trigger="hover" data-content="LinkedIn link" data-original-title="LinkedIn" required=""/>
                                         <span class="help-inline" id="error_linkedin"></span>
                                     </div>
                                 </div>
								 <div class="control-group" id="menu_edit_googleplus">
                                     <label class="control-label" for="inputError">Google+</label>
                                     <div class="controls">
                                         <input type="text" id="edit_googleplus" class="span6 popovers" value="<?php echo $data[0]['googleplus'];?>" data-trigger="hover" data-content="Google+ link" data-original-title="Google+" required=""/>
                                         <span class="help-inline" id="googleplus"></span>
                                     </div>
                                 </div>
								 
                                 <div class="form-actions">
                                     <button type="button" class="btn btn-success" onclick="javascript:save();">Save</button>
                                     <a href="<?php echo config_item("base_url")."user";?>"><button type="button" class="btn">Cancel</button></a>
                                 </div>
                             </form>
                        </div>
                    </div>
                <!-- End Of Penambahan Widget Philtyphil -->
               </div>
            </div>

            <!-- END ADVANCED TABLE widget-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
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
