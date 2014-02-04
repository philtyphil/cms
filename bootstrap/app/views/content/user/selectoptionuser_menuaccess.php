<select data-placeholder="Menu Access" class="chzn-select" multiple="multiple" tabindex="6" id="opt_menuAccess">
<option value=""></option>
<?php foreach($sDataaSelected as $key => $val):?>
<option selected value="<?php echo $val["id_main"];?>"><?php echo $val["nama_menu"];?></option>
<?php endforeach; ?> 
<?php foreach($sData as $key => $value):?>
<option value="<?php echo $value["id_main"];?>"><?php echo $value["nama_menu"];?></option>
<?php endforeach; ?>

</select>

<script type="text/javascript">
$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
</script>

