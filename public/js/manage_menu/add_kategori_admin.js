$(document).ready(function()
{
        
	$(window).load(function()
	{
        /** 
        * --------------------------------- 
        * Show When window loaded - philtyphil
        * ---------------------------------
        **/
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
	});
	/**
	|------------------------------------------
	|	Set Modal Box (icon)
	|------------------------------------------
	**/
	$("#iconselect").focus(
		function()
		{
			$("#PopupIconAdd").modal({backdrop:false,show:true}); 
		}
    );
	/**
	|------------------------------------------
	|	Set Identified Toggle Button Aktif
	|------------------------------------------
	**/
	$('#transition-percent-toggle-button').toggleButtons({
        transitionspeed: "500%"
    });
	
	 $(".chzn-select").chosen();
   
});

function getNamaMenu(val)
{
	$("#nama_menu").val(val);
}

function getClassMenu(val)
{
	$("#class_menu").val(val);
}

function getUrl(val)
{
	$("#url_menu").val(val);
}

function selecticon(val)
{
	$("#iconselect").val(val);
	$("#icon_menu").val(val);
	$("#icon_input").addClass(val);
	$("#PopupIconAdd").modal("hide");
}
function getDesc(val)
{
	$("#desc_menu").val(val);
}

function save()
{
	var data = {
		nama_menu 	: $("#nama_menu").val(),
		id_main	 	: $("#id_main").val(),
		nama_sub  	: $("#sub_menu").val(),
		link_sub	 : $("#url_menu").val(),
		icon	 	: $("#icon_menu").val(),
		description	: $("#desc_menu").val(),
		aktif		: $("input:radio[name='aktif']:checked").val()
		
	};
	var url = base_url+"menu/saveAddSubAdmin";
	$.post(url,data,function(data)
	{
		/* If Success - philtyphil */
		if(typeof(data.success) != "undefined" && data.success != "" && data.success == true)
		{
			window.location.href = base_url + "menu";
		}
		
		/** If Error!! **/
		if(typeof(data.error_nama_menu) != "undefined" && data.error_nama_menu != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_nama_menu);
			$("#addError").fadeIn("slow");
			setTimeout(function(){
				$("#addError").fadeOut("slow");
			},3000);
		}
		if(typeof(data.error_desc) != "undefined" && data.error_desc != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_desc);
			$("#addError").fadeIn("slow");
			setTimeout(function(){
				$("#addError").fadeOut("slow");
			},3000);
		}
		if(typeof(data.error_link) != "undefined" && data.error_link != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_link);
			$("#addError").fadeIn("slow");
			setTimeout(function(){
				$("#addError").fadeOut("slow");
			},3000);
		}
		if(typeof(data.error_icon) != "undefined" && data.error_icon != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_icon);
			$("#addError").fadeIn("slow");
			setTimeout(function(){
				$("#addError").fadeOut("slow");
			},3000);
		}
		if(typeof(data.error_id_main) != "undefined" && data.error_id_main != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_id_main);
			$("#addError").fadeIn("slow");
			setTimeout(function(){
				$("#addError").fadeOut("slow");
			},3000);
		}
		
	},"json");
}
function getMenu()
{
	var val = $("#submenus").val();
	var splitVal = val.split("-");
	$("#nama_menu").val(splitVal[1]);
	$("#id_main").val(splitVal[0]);
}

function getSubMenu(value)
{
	$("#sub_menu").val(value);
}

function aktif(val)
{
	alert(val);
}