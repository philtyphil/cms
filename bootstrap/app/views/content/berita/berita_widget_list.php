<?php if ( ! defined('BASEPATH') && ($this->session->userdata("logged") == false)) exit('No direct script access allowed');
/*
|-------------
| Created By Sulistyo Nur Anggoro A.K.A Philtyphils - philtyphils@gmail.com - @philtyphils on Twitter
|------------
*/
?>

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
        "sAjaxSource": "<?php echo config_item('base_url');?>berita/getberita/",
        "bProcessing": true,
        "bServerSide": true,
    });
	$('.popovers').popover();
	

</script>