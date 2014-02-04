$( document ).ready(function()
{
	
	$(window).load(function()
	{ 
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loaderberita").load(base_url+"berita/loadberitalist");
		$("#loading").fadeOut("slow");
	});

});

function usernamechange(str)
{
	$("#name_final").html(str);
}

function emailchange(str)
{
	$("#email_final").html(str);
}

function phonechange(str)
{
	$("#phone_final").html(str);
}

function reg()
{
	
	url = base_url+"register/save";
	val = {
		username 		: $("#username").val(),
		password 		: $("#password").val(),
		email	 		: $("#email").val(),
		nama_lengkap	: $("#nama_lengkap").val(),
		no_telp			: $("#no_tlp").val(),
		facebook	 	: $("#facebook").val(),
		twitter	 	: $("#twitter").val(),
		linkedin	 	: $("#linkedin").val(),
		googleplus	 	: $("#googleplus").val(),
		img				: $("#photoImg").val(),
		submit			: $("#confirm").val()
	};
	$.post(url,val,function(data){
		if(typeof(data.notif) != "undefined" && data.notif != "")
		{
			$("#loading").fadeIn("slow");
			var FormDatas = new FormData();
			jQuery.each($('#photoImg')[0].files, function(i, file) {
				FormDatas.append('file-'+i, file);
			});
			var xhr = new XMLHttpRequest();
			xhr.open('POST', base_url+"register/uploadImage", true);
			xhr.send(FormDatas);
			$("#loading").fadeOut("slow");
			$("alert_success").fadeIn("slow");
		};
	},"json");
}

/**
	var FormDatas = new FormData();
			jQuery.each($('#photoImg')[0].files, function(i, file) {
				FormDatas.append('file-'+i, file);
			});
			var xhr = new XMLHttpRequest();
			xhr.open('POST', base_url+"berita/uploadImage", true);
			xhr.send(FormDatas);
**/