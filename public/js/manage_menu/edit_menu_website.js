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
    var url = base_url+"menu/editsavewebsite";
    var data = {
        id:$("#edit_id").val(),
        namamenu:$("#edit_name").val(),
        icon:$("#iconselect").val(),
        link:$("#edit_link").val(),
        aktif:$("input[name='active']:radio").val(),
		submenu: $("#submenus").val()
    }
    $.post(url,data,function(data)
        {
            if(typeof(data.success) != "undefined" && data.success != "")
            {
                window.location.href=base_url+"menu";
            }
            if(typeof(data.error_nama != "undefined") && data.error_nama  != "")
            {
                $("#menu_edit_username").addClass("error");
                $("#error_username").html(data.error_nama);
            }
            if(typeof(data.error_link != "undefined") && data.error_link != "")
            {
                $("#menu_edit_icon").addClass("error");
                $("#error_link").html(data.error_link);
            }
            if(typeof(data.error_icon) != "undefined" && data.error_icon)
            {
                $("#error_icon").addClass("error");
                $("#error_notif_icon").html(data.error_icon);
            }
        },"json"
    )
}


