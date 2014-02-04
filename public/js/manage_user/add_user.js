$( document ).ready(function()
{
	$(window).load(function()
	{ 
		$("#loaderuser").load(base_url+"user/loaduser" );
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
	});
	
	$("input[name=blokir]:radio").click(function()
	{
		$("#blokir_user").val($(this).val());
	});
	
	$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
});
function getNamaLengkap(val)
{
	$("#namalengkap_user").val(val);
}
function getUsername(val)
{
	$("#username_user").val(val);
}
function getpassword(val)
{
	$("#password_user").val(val);
}
function getEmail(val)
{
	$("#email_user").val(val);
}
function getTelp(val)
{
	$("#notelp_user").val(val);
}
function getrole(val)
{
	$("#level_user").val(val);
}

function save()
{
	var level = $("#level_user").val();
	var lvl = level.split(" - ");
	var data = {
		nama_lengkap: $("#namalengkap_user").val(),
		username	: $("#username_user").val(),
		password	: $("#password_user").val(),
		email		: $("#email_user").val(),
		role_id		: lvl[0],
		level		: lvl[1],
		no_telp		: $("#notelp_user").val(),
		blokir		: $("#blokir_user").val(),
		submit		: "submit"
	}
	var url = base_url+"user/addUser";
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		dataType: "json",
		success: function (data)
		{
		
			if(data.error_username != "" && typeof(data.error_username) != "undefined")
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_username);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			else if(data.error_password != "" && typeof(data.error_password) != "undefined" )
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_password);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			else if(data.error_email != "" && typeof(data.error_email) != "undefined" )
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_email);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			else if(data.error_notelp != "" && typeof(data.error_notelp) != "undefined" )
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_notelp);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			else if(data.error_namalengkap != "" && typeof(data.error_namalengkap) != "undefined" )
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_namalengkap);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			else if(data.error_blokir != "" && typeof(data.error_blokir) != "undefined" )
			{
				$("#addError").fadeIn("slow");
				$("#writeErrorAddOnjQuery").html(data.error_blokir);
				setTimeout(function(){
					$("#addError").fadeOut("slow");
				},4500);
			}
			
			if(data.notif)
			{
				
				window.location.href = base_url + "user/";
			}
			
		}
	});

}