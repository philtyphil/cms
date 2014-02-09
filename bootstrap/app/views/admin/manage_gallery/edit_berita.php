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
                     Manage <?php echo $function; ?>  edit <a href="#"><i class="icon-reorder"></i></a>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo config_item('base_url');?>dashboard">Home</a>
                           <span class="divider">/</span>
                       </li>
                       <li>
                           <a href="#">Manage <?php echo ucfirst($function); ?> edit </a>
                          
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
                        <h4><i class="icon-tasks"></i> <?php echo ucfirst(htmlentities($function)); ?> edit  </h4>
                            <span class="tools">
                                <a href="javascript:;" class="icon-chevron-down"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <form action="#" class="form-horizontal" >
                                <input type="hidden" id="edit_id" value="<?php echo $data[0]['id_berita'];?>">
                                <div class="control-group " id="menu_edit_username">
                                     <label class="control-label" for="inputError">Username</label>
                                     <div class="controls">
                                         <input type="text" id="edit_username_berita" readonly="readonly" class="span6 popovers" value="<?php echo $data[0]['username'];?>" data-trigger="hover" data-content="Someone has wrote this article" data-original-title="Create" required=""/>
                                         <span class="help-inline" id="error_username"></span>
                                     </div>
                                 </div>
                                <div class="control-group" id="menu_edit_judul">
                                     <label class="control-label" for="inputError">Judul</label>
                                     <div class="controls">
                                         <input type="text" id="edit_judul_berita" value="<?php echo $data[0]['judul'];?>" class="span6  popovers" data-trigger="hover" data-content="Article Title" data-original-title="Title" />
                                         <span class="help-inline" id="error_judul"></span>
                                     </div>
                                </div>
								<div class="control-group" id="menu_edit_icon">
                                     <label class="control-label" for="inputError">Tanggal</label>
                                     <div class="controls">
                                         <input type="text" id="edit_tanggal_berita" readonly="readonly" value="<?php echo $data[0]['tanggal'];?>" class="span6  popovers" data-trigger="hover" data-content="Date Created Article (yyyy-mm-dd)" data-original-title="Date Create" />
                                         <span class="help-inline" id="error_tanggal"></span>
                                     </div>
                                </div>
								<div class="control-group" id="menu_edit_tanggal_edit">
                                     <label class="control-label" for="inputError">Tanggal Edit</label>
                                     <div class="controls">
                                         <input type="text" id="edit_tanggal" readonly="readonly" value="<?php echo date("Y-m-d");?>" class="span6  popovers" data-trigger="hover" data-content="Date Created Article (yyyy-mm-dd)" data-original-title="Date Create" />
                                         <span class="help-inline" id="error_tanggal_edit"></span>
                                     </div>
                                </div>
								<div class="control-group">
                                    <label class="control-label">Image Upload</label>
                                    <div class="controls">
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
												<?php if(file_exists("public/images/img_uploaded/beritaheader_".$data[0]['gambar'])):?>
													<img alt="" src="<?php echo config_item('base_url');?>public/images/img_uploaded/beritaheader_<?php echo $data[0]["gambar"];?>"/>
												<?php else: ?>
													<img alt="" src="<?php echo config_item('base_url');?>public/images/default/AAAAAA&text=no+image.gif"/>
												<?php endif; ?>
                                            </div>
                                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input id="photoImg" type="file" class="default"></span>
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
								<div class="control-group" id="menu_edit_berita">
                                     <label class="control-label" for="inputError">Isi Berita</label>
                                     <div class="controls">
                                        <div class="summernote" id="editor1" >
											<?php echo $data[0]["isi_berita"];?>
										</div>
                                     </div>
									 <span class="help-inline" id="error_edit_berita"></span>
                                </div>
								
								<div class="control-group" id="menu_edit_tag">
                                     <label class="control-label" for="inputError">Tags</label>
                                     <div class="controls">
                                        <input id="tags_1" type="text" class="tags" value="<?php echo $data[0]['tag'];?>" />
									</div>
									 <span class="help-inline" id="error_tag_berita"></span>
                                </div>
                        
                                 <div class="form-actions">
                                     <button type="button" class="btn btn-success" id="editsave">Save</button>
                                     <a href="<?php echo config_item("base_url")."berita";?>"><button type="button" class="btn">Cancel</button></a>
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
   <!-- Modal -->
<div id="PopupIcon" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
