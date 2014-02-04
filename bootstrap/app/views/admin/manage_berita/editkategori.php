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
                     Manage <?php echo ucfirst($function); ?>  Kategori <b>Edit</b> <a href="#"><i class="icon-reorder"></i></a>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo config_item('base_url');?>dashboard">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Manage <?php echo ucfirst($function); ?> Kategori <b> Edit</b> </a>
                          
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
                    <div class="widget red">
                        <div class="widget-title">
                        <h4><i class="icon-tasks"></i> <?php echo ucfirst($function); ?> edit  </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
							<!-- Begin NOTIFIKASI ERROR -->
							<div class="alert alert-block alert-info" style="display:none;" id="success">
								<button class="close" type="button" data-dismiss="alert">&#215;</button>
								<h4 class="alert-heading">Success!</h4>
								<p> Manage Kategori Berita Success!!. Congratulation!! </p>
							</div>
							<div class="alert alert-block alert-error" style="display:none;" id="error">
								<button class="close" type="button" data-dismiss="alert">&#215;</button>
								<h4 class="alert-heading">Error!</h4>
								<p id="error_notif"> </p>
							</div>
							<!-- END OF NOTIFIKASI -->
							<div action="#" class="form-horizontal" >
								<div class="control-group" id="nama_kategori">
                                     <label class="control-label" for="inputError">Nama Kategori</label>
                                     <div class="controls">
                                         <input type="hidden" id="id_kategori_edit" value="<?php echo $data[0]['id_kategori'];?>"/>
										 <input type="text" id="edit_nama_kategori" value="<?php echo $data[0]['nama_kategori'];?>" class="span6  tooltips" data-trigger="hover"  data-original-title="Nama Kategori" />
                                         <span class="help-inline" id="error_nama_kategori"></span>
                                     </div>
                                </div>
								<div class="control-group" id="nama_kategori">
                                     <label class="control-label" for="inputError">Kategori-SEO</label>
                                     <div class="controls">
                                         <input type="text" readonly="readonly" id="edit_nama_kategori_SEO" value="<?php echo $data[0]['kategori_seo'];?>" class="span6  tooltips" data-trigger="hover"  data-original-title="Kategori SEO" />
                                         <span class="help-inline" id="error_kategori_seo"></span>
                                     </div>
                                </div>
								<div class="control-group" id="nama_kategori">
                                     <label class="control-label" for="inputError">Aktif</label>
                                     <div class="controls">
										<?php echo $aktif = ($data[0]['aktif'] == "Y") ? '<input type="radio" name="aktif" value="Y" class="tooltips" data-trigger="hover"  data-original-title="AKTIF" checked/> Y <br/>
                                         <input type="radio" name="aktif" value="N" class="tooltips" data-trigger="hover"  data-original-title="NON-AKTIF" /> N <br/>' : '<input type="radio" name="aktif" value="Y" class="tooltips" data-trigger="hover"  data-original-title="AKTIF" /> Y <br/>
                                         <input type="radio" name="aktif" value="N" class="tooltips" data-trigger="hover"  data-original-title="NON-AKTIF" checked /> N <br/>';?>
                                        <span class="help-inline" id="error_aktif"></span>
                                     </div>
                                </div>
								<div class="form-actions">
                                     <button type="button" class="btn btn-success tooltips" id="saved_kategori" data-trigger="hover"  data-original-title="Click To Save">Save</button>
                                     <a href="<?php echo config_item("base_url")."berita";?>"><button type="button" class="btn">Cancel</button></a>
                                 </div>
							</div>
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
<!-- MODAL CONFIRM-->

<!-- END OF MODAL CONFIRM -->
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
