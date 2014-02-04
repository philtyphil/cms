<?php if ( ! defined('BASEPATH') && ($this->session->userdata("logged") == false)) exit('No direct script access allowed');
/*
|-------------
| Created By Sulistyo Nur Anggoro A.K.A Philtyphils - philtyphils@gmail.com - @philtyphils on Twitter
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
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr #users { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr#users { border: 1px solid #ccc; }
	
	td#users { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}
	
	td#users:before { 
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
	td#users:nth-of-type(1):before { content: ""; }

}
</style>
<div id="addButton" style="margin-bottom:20px;">
	<button type="button" class="btn btn-primary" onclick="javascript:window.location.href='<?php echo config_item("base_url");?>berita/add'">
		<i class="icon-plus-sign"></i> Add Berita
	</button>
</div>
<!-- <table class="table table-striped table-bordered" id="users">-->

<table class="table " id="users">
<thead>
	<th>Berita TimeLine</th>
</thead>
<tbody ></tbody>
</table>
<script type="text/javascript">
 $('#users').dataTable({
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
        "sAjaxSource": "<?php echo config_item('base_url');?>berita/getberita",
        "bProcessing": true,
        "bServerSide": true,
    });
	$('.popovers').popover();
</script>