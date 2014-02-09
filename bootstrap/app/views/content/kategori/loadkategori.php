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
	table#kategori_table, table#kategori_table thead, table#kategori_table tbody,table#kategori_table th,table#kategori_table td,table#kategori_table tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	table#kategori_table thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	table#kategori_table tr { border: 1px solid #ccc; }
	
	table#kategori_table td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	table#kategori_table td:before { 
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
	table#kategori_table td:nth-of-type(1):before { content: "kategori"; }
	table#kategori_table td:nth-of-type(2):before { content: "kategori SEO"; }
	table#kategori_table td:nth-of-type(3):before { content: "Aktif"; }
	table#kategori_table td:nth-of-type(4):before { content: "Action"; }
}
</style>
<div id="addButton" style="margin-bottom:20px;">
	
	<button type="button" class="btn btn-success" onclick="javascript:window.location.href='<?php echo config_item("base_url");?>berita/actionkategori/add'">
		<i class="icon-plus-sign"></i> Add Category
	</button>
</div>
<table class="table table-striped table-bordered" id="kategori_table">
<thead>
	<th>Kategori</th>
	<th>kategori SEO</th>
	<th style="width:3%;">Aktif</th>
	<th  style="width:10%;">Action</th>
</thead>
<tbody></tbody>
</table>
<script type="text/javascript">
 $("#kategori_table").dataTable({
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
        "sAjaxSource": "<?php echo config_item('base_url');?>berita/getkategori",
        "bProcessing": true,
        "bServerSide": true,
		 "aaSorting": [[ 1, "desc" ]]
    });
</script>