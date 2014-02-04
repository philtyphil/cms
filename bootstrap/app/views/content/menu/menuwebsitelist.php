<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|-------------
| Created By Sulistyo Nur Anggoro A.K.A Philtyphils - philtyphils@gmail.com
|------------
*/
?>
<style>
	/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	/* Force table to not be like tables anymore */
	table#menuwebsite_list, table#menuwebsite_list thead, table#menuwebsite_list tbody,table#menuwebsite_list th,table#menuwebsite_list td,table#menuwebsite_list tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	table#menuwebsite_list thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	table#menuwebsite_list tr { border: 1px solid #ccc; }
	
	table#menuwebsite_list td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	table#menuwebsite_list td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
	}
	
	/*
	Label the data
	*/
	table#menuwebsite_list td:nth-of-type(1):before { content: "Nama Menu"; }
	table#menuwebsite_list td:nth-of-type(2):before { content: "link"; }
	table#menuwebsite_list td:nth-of-type(3):before { content: "Aktif"; }
	table#menuwebsite_list td:nth-of-type(4):before { content: "Icon"; }
}
</style>
<div id="addButton" style="margin-bottom:20px;">
	<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?php echo config_item("base_url");?>menu/addmenuwebsite'">
		<i class="icon-plus-sign"></i> Add Menu
	</button>
	<button type="button" class="btn btn-success" onclick="javascript:window.location.href='<?php echo config_item("base_url");?>menu/addKategori'">
		<i class="icon-plus-sign"></i> Add Category
	</button>
</div>
<table class="table table-striped table-bordered" id="menuwebsite_list">
<thead>
	<th>Nama Menu</th>
	<th>link</th>
	<th style="width:3%;">Aktif</th>
	<th>Icon</th>
	<th  style="width:3%;">Action</th>
</thead>
<tbody></tbody>
</table>
<script type="text/javascript">
 $("#menuwebsite_list").dataTable({
        "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            }
        },
        "aoColumnDefs": [{
            'bSortable': false,'aTargets': [0]
        }],
        "sAjaxSource": "<?php echo config_item('base_url');?>menu/getlistmenuwebsite",
        "bProcessing": true,
        "bServerSide": true,
		 "aaSorting": [[ 1, "desc" ]]
    });
</script>