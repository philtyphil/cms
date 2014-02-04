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
                               <span class="username">Jhon Doe</span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
                               <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
                               <li><a href="#"><i class="icon-cog"></i> My Settings</a></li>
                               <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
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
   <!-- END HEADER --
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
                     Manage <?php echo $function; ?>  Add <a href="#"><i class="icon-reorder"></i></a>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo config_item('base_url');?>admin/index">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Manage <?php echo $function; ?> Add </a>
                          
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
                        <h4><i class="icon-tasks"></i> <?php echo $function; ?> Add  </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
							<div id="addError" class="alert alert-block alert-error" style="display:none;">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              <h4 class="alert-heading">Error!</h4>
                              <p id="writeErrorAddOnjQuery">
                                  <!--
								  |--------------------------------
								  |	tag untuk menampilkan error, di tulis di javascript function saveAdd();
								  |--------------------------------
								  -->
                              </p>
							</div>
						
                            <form class="form-horizontal" >
								<div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Step 1</span> <span class="muted">Menu Details</span></a></li>
                                    <li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Step 2</span> <span class="muted">Url Details</span></a></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Step 3</span> <span class="muted">Icon Details</span></a></a></li>
                                    <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong">Step 4</span> <span class="muted">Confirmation</span></a></a></li>
                                </ul>
                                <div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
                                        <h3>Fill up step 1</h3>
                                        <div class="control-group">
                                            <label class="control-label">Nama Menu</label>
                                            <div class="controls">
                                                <input type="text" onchange="getNamaMenu(this.value);" class="span6">
                                                <span class="help-inline">Isikan dengan nama menu</span>
                                            </div>
                                        </div>
										 <div class="control-group">
                                            <label class="control-label">Sub Menu</label>
                                            <div class="controls">
												<select onchange="getSubMenu();" id="submenus" data-placeholder="Sub menu" class="chzn-select span6" multiple="multiple" >
													<?php foreach($submenu as $key => $value):?>
														<option><?php echo $value["nama_sub"];?></option>
													<?php endforeach; ?>
												</select>
												
                                                <span class="help-inline">Pilih submenu</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Class Menu</label>
                                            <div class="controls">
                                                <input type="text" onchange="getClassMenu(this.value);" class="span6">
                                                <span class="help-inline">Isikan dengan Controller Class</span>
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label class="control-label">Aktif</label>
                                            <div class="controls">
													<input value="Y" id="aktif_menu" type="radio" name="aktif" checked="checked"> Yes <br/>
													<input value="N" name="aktif" type="radio" > No <br/>
												
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab2">
                                        <h3>Fill up step 2</h3>
                                        <div class="control-group">
                                            <label class="control-label">URL Address</label>
                                            <div class="controls">
                                                <input type="url" onchange="getUrl(this.value)" class="span6">
                                                <span class="help-inline">Give your URL Adress</span>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3>Fill up step 3</h3>
                                        <div class="control-group">
                                            <label class="control-label">Select Icon</label>
                                            <div class="controls">
                                                <input type="text" id="iconselect" onchange="getIcon(this.value)" class="span6" />
                                                <span class="help-inline"></span>
                                            </div>
                                        </div>

                                       
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab4">
                                        <h3>Final step</h3>
                                        <div class="control-group">
                                            <label class="control-label">Nama Menu:</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" id="nama_menu">
                                            </div>
                                        </div>
										<div class="control-group">
                                            <label class="control-label">Sub Menu:</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" id="sub_menu">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Class Menu:</label>
                                            <div class="controls">
                                                <input type="text" readonly="readonly" id="class_menu">
                                            </div>
                                        </div>
										
										<div class="control-group">
                                            <label class="control-label">Icon:</label>
                                            <div class="controls input-icon left">
												<i id="icon_input"></i>
                                                <input type="text" style="width:160px;" readonly="readonly" id="icon_menu">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Url Adress:</label>
                                            <div class="controls ">
												<input type="text" readonly="readonly" id="url_menu">
                                            </div>
                                        </div>
										
                                        <div class="control-group">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <label class="checkbox">
                                                    <input type="checkbox" id="confirm"/> I confirm my steps
                                                </label>
                                            </div>
                                        </div>
										 
										<div class="control-group">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <a href="javascript:;" onclick="javascript:save();" class="btn btn-success" id="pulsate-once">Save</a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="pager wizard">
                                        <li class="previous first"><a href="javascript:;">First</a></li>
                                        <li class="previous"><a href="javascript:;">Previous</a></li>
                                        <li class="next last"><a href="javascript:;">Last</a></li>
                                        <li class="next"><a href="javascript:;">Next</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                            </form> <!-- End of Form -->
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
   <!-- Modal -->
<div id="PopupIconAdd" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Select Icon</h3>
  </div>
  <div class="modal-body">
    <div onclick="selecticon('icon-collapse')" class="span2"><i class="icon-collapse"></i> icon-collapse</div>
    <div onclick="selecticon('icon-collapse-top')" class="span2"><i class="icon-collapse-top"></i> icon-collapse-top</div>
    <div onclick="selecticon('icon-expand')" class="span2"><i class="icon-expand"></i> icon-expand</div>
    <div onclick="selecticon('icon-eur')" class="span2"><i class="icon-eur"></i> icon-eur</div>
    <div onclick="selecticon('icon-euro')" class="span2"><i class="icon-euro"></i> icon-euro <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-gbp')" class="span2"><i class="icon-gbp"></i> icon-gbp</div>
    <div onclick="selecticon('icon-usd')" class="span2"><i class="icon-usd"></i> icon-usd</div>
    <div onclick="selecticon('icon-dollar')" class="span2"><i class="icon-dollar"></i> icon-dollar <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-inr')" class="span2"><i class="icon-inr"></i> icon-inr</div>
    <div onclick="selecticon('icon-rupee')" class="span2"><i class="icon-rupee"></i> icon-rupee <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-jpy')" class="span2"><i class="icon-jpy"></i> icon-jpy</div>
    <div onclick="selecticon('icon-yen')" class="span2"><i class="icon-yen"></i> icon-yen <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-cny')" class="span2"><i class="icon-cny"></i> icon-cny</div>
    <div onclick="selecticon('icon-renminbi')" class="span2"><i class="icon-renminbi"></i> icon-renminbi <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-krw')" class="span2"><i class="icon-krw"></i> icon-krw</div>
    <div onclick="selecticon('icon-won')" class="span2"><i class="icon-won"></i> icon-won <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-btc')" class="span2"><i class="icon-btc"></i> icon-btc</div>
    <div onclick="selecticon('icon-bitcoin')" class="span2"><i class="icon-bitcoin"></i> icon-bitcoin <span class="muted">(alias)</span></div>
    <div onclick="selecticon('icon-file')" class="span2"><i class="icon-file"></i> icon-file</div>
    <div onclick="selecticon('icon-file-text')" class="span2"><i class="icon-file-text"></i> icon-file-text</div>
    <div onclick="selecticon('icon-sort-by-alphabet')" class="span2"><i class="icon-sort-by-alphabet"></i> icon-sort-by-alphabet</div>
    <div onclick="selecticon('icon-sort-by-alphabet-alt')" class="span2"><i class="icon-sort-by-alphabet-alt"></i> icon-sort-by-alphabet-alt</div>
    <div onclick="selecticon('icon-sort-by-attributes')" class="span2"><i class="icon-sort-by-attributes"></i> icon-sort-by-attributes</div>
    <div onclick="selecticon('icon-sort-by-attributes-alt')" class="span2"><i class="icon-sort-by-attributes-alt"></i> icon-sort-by-attributes-alt</div>
    <div onclick="selecticon('icon-sort-by-order')" class="span2"><i class="icon-sort-by-order"></i> icon-sort-by-order</div>
    <div onclick="selecticon('icon-sort-by-order-alt')" class="span2"><i class="icon-sort-by-order-alt"></i> icon-sort-by-order-alt</div>
    <div onclick="selecticon('icon-thumbs-up')" class="span2"><i class="icon-thumbs-up"></i> icon-thumbs-up</div>
    <div onclick="selecticon('icon-thumbs-down')" class="span2"><i class="icon-thumbs-down"></i> icon-thumbs-down</div>
    <div onclick="selecticon('icon-youtube-sign')" class="span2"><i class="icon-youtube-sign"></i> icon-youtube-sign</div>
    <div onclick="selecticon('icon-youtube')" class="span2"><i class="icon-youtube"></i> icon-youtube</div>
    <div onclick="selecticon('icon-xing')" class="span2"><i class="icon-xing"></i> icon-xing</div>
    <div onclick="selecticon('icon-xing-sign')" class="span2"><i class="icon-xing-sign"></i> icon-xing-sign</div>
    <div onclick="selecticon('icon-youtube-play')" class="span2"><i class="icon-youtube-play"></i> icon-youtube-play</div>
    <div onclick="selecticon('icon-dropbox')" class="span2"><i class="icon-dropbox"></i> icon-dropbox</div>
    <div onclick="selecticon('icon-stackexchange')" class="span2"><i class="icon-stackexchange"></i> icon-stackexchange</div>
    <div onclick="selecticon('icon-instagram')" class="span2"><i class="icon-instagram"></i> icon-instagram</div>
    <div onclick="selecticon('icon-flickr')" class="span2"><i class="icon-flickr"></i> icon-flickr</div>
    <div onclick="selecticon('icon-adn')" class="span2"><i class="icon-adn"></i> icon-adn        </div>
    <div onclick="selecticon('icon-bitbucket')" class="span2"><i class="icon-bitbucket"></i> icon-bitbucket</div>
    <div onclick="selecticon('icon-itbucket-sign')" class="span2"><i class="icon-bitbucket-sign"></i> icon-bitbucket-sign</div>
    <div onclick="selecticon('icon-tumblr')" class="span2"><i class="icon-tumblr"></i> icon-tumblr</div>
    <div onclick="selecticon('icon-tumblr-sign')" class="span2"><i class="icon-tumblr-sign"></i> icon-tumblr-sign</div>
    <div onclick="selecticon('icon-long-arrow-down')" class="span2"><i class="icon-long-arrow-down"></i> icon-long-arrow-down</div>
    <div onclick="selecticon('icon-long-arrow-up')" class="span2"><i class="icon-long-arrow-up"></i> icon-long-arrow-up</div>
    <div onclick="selecticon('icon-long-arrow-left')" class="span2"><i class="icon-long-arrow-left"></i> icon-long-arrow-left</div>
    <div onclick="selecticon('icon-long-arrow-right')" class="span2"><i class="icon-long-arrow-right"></i> icon-long-arrow-right</div>
    <div onclick="selecticon('icon-apple')" class="span2"><i class="icon-apple"></i> icon-apple</div>
    <div onclick="selecticon('icon-windows')" class="span2"><i class="icon-windows"></i> icon-windows</div>
    <div onclick="selecticon('icon-android')" class="span2"><i class="icon-android"></i> icon-android</div>
    <div onclick="selecticon('icon-linux')" class="span2"><i class="icon-linux"></i> icon-linux</div>
    <div onclick="selecticon('icon-dribbble')" class="span2"><i class="icon-dribbble"></i> icon-dribbble</div>
    <div onclick="selecticon('icon-skype')" class="span2"><i class="icon-skype"></i> icon-skype</div>
    <div onclick="selecticon('icon-foursquare')" class="span2"><i class="icon-foursquare"></i> icon-foursquare</div>
    <div onclick="selecticon('icon-trello')" class="span2"><i class="icon-trello"></i> icon-trello</div>
    <div onclick="selecticon('icon-female')" class="span2"><i class="icon-female"></i> icon-female</div>
    <div onclick="selecticon('icon-male')" class="span2"><i class="icon-male"></i> icon-male</div>
    <div onclick="selecticon('icon-gittip')" class="span2"><i class="icon-gittip"></i> icon-gittip</div>
    <div onclick="selecticon('icon-sun')" class="span2"><i class="icon-sun"></i> icon-sun</div>
    <div onclick="selecticon('icon-moon')" class="span2"><i class="icon-moon"></i> icon-moon</div>
    <div onclick="selecticon('icon-archive')" class="span2"><i class="icon-archive"></i> icon-archive</div>
    <div onclick="selecticon('icon-bug')" class="span2"><i class="icon-bug"></i> icon-bug</div>
    <div onclick="selecticon('icon-vk')" class="span2"><i class="icon-vk"></i> icon-vk</div>
    <div onclick="selecticon('icon-weibo')" class="span2"><i class="icon-weibo"></i> icon-weibo</div>
    <div onclick="selecticon('icon-renren')" class="span2"><i class="icon-renren"></i> icon-renren</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div> <!-- end of div="PopupIcon" (Popup Select Icon) -->

	
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
