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
         * --------------------------------- 
         * Identified Modal To Icon Select - philtyphil
         * ---------------------------------
        **/
        $("#iconselect").focus(
                function()
                {
                    $("#PopupIcon").modal({backdrop:false,show:true}); 
                }
         );
         /**
          * -------------------------
          * @Identyfied toggle button - $(selector).toggleButtons(); - philtyphil
          * ----------------------------
          */
         $('#normal-toggle-button').toggleButtons();
         
         $("#editsave").click(
            function()
            {
                save();
            }
         );
		 $(".chzn-select").chosen(); 
});

function selecticon(icon)
{
    $("#iconselect").val(icon);
     $("#PopupIcon").modal("hide"); 
}

function save()
{
    var url = base_url+"menu/editsaveSubmenu";
    var data = {
        id_sub		:$("#edit_id").val(),
        nama_sub	:$("#edit_namesub_menu").val(),
        link_sub	:$("#edit_link").val(),
        icon		:$("#iconselect").val(),
        aktif		:$("#edit_active").val(),
        description		:$("#edit_desc").val()
    }
    $.post(url,data,function(data)
        {
            if(typeof(data.success) != "undefined" && data.success != "")
            {
                window.location.href=base_url+"menu";
            }
            if(typeof(data.error_nama_sub != "undefined") && data.error_nama_sub  != "")
            {
                $("#menu_edit_username").addClass("error");
                $("#error_username").html(data.error_nama_sub);
            }
            if(typeof(data.error_link != "undefined") && data.error_link != "")
            {
                $("#menu_edit_icon").addClass("error");
                $("#error_link").html(data.error_link);
            }
			 if(typeof(data.error_description != "undefined") && data.error_description != "")
            {
                $("#menu_edit_Description").addClass("error");
                $("#error_link").html(data.error_description);
            }
            if(typeof(data.error_icon) != "undefined" && data.error_icon)
            {
                $("#error_icon").addClass("error");
                $("#error_notif_icon").html(data.error_icon);
            }
        },"json"
    )
}

