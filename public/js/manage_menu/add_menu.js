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

function save()
{
	var data = {
		nama_menu 	: $("#nama_menu").val(),
		class	 	: $("#class_menu").val(),
		link	 	: $("#url_menu").val(),
		icon	 	: $("#icon_menu").val()
		
	};
	var url = base_url+"menu/saveAdd";
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
		if(typeof(data.error_class) != "undefined" && data.error_class != "")
		{
			$("#writeErrorAddOnjQuery").html(data.error_class);
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
		
	},"json");
}
function getSubMenu()
{
	var val = $("#submenus").val();
	alert(val);
}