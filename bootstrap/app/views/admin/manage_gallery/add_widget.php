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
                     Manage <?php echo $function; ?>  Add Widget <?php echo $widget[0]["nama_sub"];?> <a href="#"><i class="icon-reorder"></i></a>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo config_item('base_url');?>dashboard">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Manage <?php echo $function; ?> Add Widget <?php echo $widget[0]["nama_sub"];?></a>
                          
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
                        <h4><i class="icon-tasks"></i> <?php echo $function; ?> Add Widget <?php echo $widget[0]["nama_sub"]; ?>  </h4>
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
						
                            <div class="form-horizontal" >
								<div id="tabsleft" class="tabbable tabs-left">
                                <ul>
                                    <li><a href="#tabsleft-tab1" data-toggle="tab"><span class="strong">Step 1</span> <span class="muted">Header Widget Details</span></a></li>
                                    <li><a href="#tabsleft-tab2" data-toggle="tab"><span class="strong">Step 2</span> <span class="muted">Widget  Details</span></a></a></li>
                                    <li><a href="#tabsleft-tab3" data-toggle="tab"><span class="strong">Step 3</span> <span class="muted">Image Upload</span></a></a></li>
                                    <li><a href="#tabsleft-tab4" data-toggle="tab"><span class="strong">Step 4</span> <span class="muted">Confirmation</span></a></a></li>
                                </ul>
                                <div class="progress progress-info progress-striped">
                                    <div class="bar"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tabsleft-tab1">
                                        <h3>Fill up step 1</h3>
										<div class="control-group" id="add_judul_berita_kategori">
                                            <label class="control-label">Widget</label>
                                            <div class="controls">
                                                <input type="text" id="judulberitaKategoriPhiltyphil" value="<?php echo $widget[0]["nama_sub"];?>" class="span6" readonly="readonly" name="kategori">
                                                <span class="help-inline" id="err_kategori"></span>
                                            </div>
                                        </div>
										
                                        <div class="control-group" id="add_judul_berita">
                                            <label class="control-label">Judul</label>
                                            <div class="controls">
                                                <input type="text" id="judulberitaPhiltyphil"  class="span6" name="judul">
                                                <span class="help-inline">Give Your Title</span>
                                            </div>
                                        </div>
										
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab2">
                                        <h3>Fill up step 2</h3>
                                        <div class="control-group">
                                                <textarea class="ckeditor" id="berita" name="berita" ></textarea>
                                        </div>
										<div class="control-group" id="add_judul_berita">
                                            <label class="control-label">Tags</label>
                                            <div class="controls">
                                               <input id="tags_1" type="text" class="tags" value="philtyphil" />

                                                <span class="help-inline">Give Your Title</span>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="tab-pane" id="tabsleft-tab3">
                                        <h3>Fill up step 3</h3>
                                        <div class="control-group">
                                            <label class="control-label">Upload Image</label>
                                           <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                                            </div>
                                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input id="photoImg" type="file" class="default"/></span>
                                                <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                            </div>
                                        </div>
                                        <span class="label label-important">NOTE!</span>
                                         <span>
                                         Attached image thumbnail is
                                         supported in Latest Firefox, Chrome, Opera,
                                         Safari and Internet Explorer 10 only
                                         </span>
                                        </div>

                                       
                                    </div>
                                    <div class="tab-pane" id="tabsleft-tab4">
                                        <h3>Final step</h3>
										<div class="alert alert-block alert-info fade in">
											<button data-dismiss="alert" class="close" type="button">×</button>
											<h4 class="alert-heading">Info!</h4>
											<p>
												Click <span style="color:red;"> Save </span> To save your news or Cancel to back.
											</p>
										</div>
										<div class="alert alert-block alert-error fade in" style="display:none;">
											<button data-dismiss="alert" class="close" type="button">×</button>
											<h4 class="alert-heading">Error!!</h4>
											<p style="beritaErrorNotification">
												
											</p>
										</div>
										<div class="control-group">

                                            <div class="controls">
												
                                                <button  onClick="savingdatakategori(<?php echo $id;?>)" class="btn btn-success" id="pulsate-hover">Save</button>
												 <a href="<?php echo config_item('base_url');?>berita/widget/<?php echo $id;?>" class="btn" id="pulsate-crazy">Cancel</a>
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
                            </div> <!-- End of Form -->
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
