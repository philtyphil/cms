<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed - philtyphil');
/*
|----------------------------------------
| Created By: Sulistyo Nur Anggoro - @philtyphils 
|----------------------------------------
*/
foreach($data as $key => $value)
{
	if(empty($value["submenu"]))
	{
		echo '<li class="sub-menu">';
		echo '<a class="" href="'.$value['link'].'">';
		echo '<i class="'.$value["icon"].'"></i>';
		echo '<span>'.$value["nama_menu"].'</span>';
		echo '</a>';
		echo '</li>';
	}
	else
	{
		echo '<li class="sub-menu">';
		echo ' <a href="javascript:;" class="">';
		echo '<i class="'.$value["icon"].'"></i>';
		echo '<span>'.$value["nama_menu"].'</span>';
		echo '<span class="arrow"></span>';
		echo '</a>';
		echo '<ul class="sub">'; ?>
		<li><a class="" href="<?php echo $value["link"]; ?>"><?php echo $value["nama_menu"];?></a></li>
		<?php
		foreach($value["submenu"] as $key => $val)
		{
		?>
			<li><a class="" href="<?php echo config_item("base_url").$val["link_sub"].$val["id_sub"]; ?>"><?php echo $val["nama_sub"];?></a></li>
		<?php
		} 
		echo '</ul>';
		echo '</li>';
	}
}

?>

<li class="sub-menu">
<a class="" href="<?php echo config_item('base_url');?>logout" ><i class="icon-off"></i> <span> Logout</span></a> 
</li>

<script>
jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
    });
</script>