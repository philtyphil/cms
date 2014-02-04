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
$(".chzn-select-deselect").chosen({allow_single_deselect:true});
});

function save()
{
	var level 	= $("#edit_level_user").val();
	var lvl		= level.split(" - ");
    var url 	= base_url+"user/editsave";
    var data 	= {
        nama_lengkap:$("#edit_namalengkap_user").val(),
        username	:$("#edit_username_user").val(),
        password	:$("#edit_password_user").val(),
        email		:$("#edit_email_user").val(),
        no_telp		:$("#edit_notelp_user").val(),
        blokir		:$("input[name=edit_blokir]:checked").val(),
        level		:lvl[1],
		role_id		:lvl[0],
		submit		: "submit"
    };
    $.post(url,data,function(data)
        {
            if(typeof(data.success) != "undefined" && data.success != "")
            {
                window.location.href=base_url+"user";
            }
            if(typeof(data.error_username != "undefined") && data.error_username  != "")
            {
                $("#menu_edit_username").addClass("error");
                $("#error_username").html(data.error_username);
            }
            if(typeof(data.error_email != "undefined") && data.error_email != "")
            {
                $("#menu_edit_email").addClass("error");
                $("#error_email").html(data.error_email);
            }
            if(typeof(data.error_namalengkap) != "undefined" && data.error_namalengkap)
            {
                $("#menu_edit_namalengkap").addClass("error");
                $("#error_namalengkap").html(data.error_namalengkap);
            }
			if(typeof(data.error_notelp) != "undefined" && data.error_notelp)
            {
                $("#menu_edit_notelp").addClass("error");
                $("#error_notelp").html(data.error_notelp);
            }
        },"json"
    )
}

