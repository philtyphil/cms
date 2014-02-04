$( document ).ready(function()
{
	$(window).load(function()
	{ 
		$("#loaderuser").load(base_url+"user/loaduser" );
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
	});
	$("#saveusers").click(function()
	{
		saveuser();
	});
	
	$(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
});

function deleteuser(username)
{
	$.getJSON(base_url+"user/deleteuser/"+username, function( data )
	{
		$("#loaderuser").load(base_url+"user/loaduser" );
	});
}

function saveuser()
{
	if($("#blokir").is(":checked"))
	{
		var stat = "Y";
	}
	else
	{
		var stat = "N";
	}
	var data = {
		username	: $("#cname").val(),
		password	: $("#cpassword").val(),
		password	: $("#cemail").val(),
		blokir		: stat,
		role		: $("#select_role").val(),
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
				alert(data.error_username);
			}
			else if(data.error_password != "" && typeof(data.error_password) != "undefined" )
			{
				alert(data.error_password);
			}
			
			if(data.notif)
			{
				
				window.location.href = url_js + "user/logged/";
			}
			else
			{
				alert("Login gagal!");
			}
		}
	});

}

function grupaccess(value)
{
	$("#loadingselect").fadeIn("slow");
	$("#menuAccess").load(base_url+"user/loadopt/"+value);
	$("#loadingselect").fadeOut("slow");
}

function saveMenuAccess()
{
	url 	= base_url+"user/savemenuaccess";
	data 	= {
		id_main : $("#groupaccess").val(),
		id_menu	: $("#opt_menuAccess").val(),
		submit	: "submit"
	}
	$.post(url,data,function(e){
		if(typeof(e.success) != "undefined" && e.success != "")
		{
			window.location.href=base_url+"user"
		}
		
		if(typeof(e.error_id_main) != "undefined" && e.error_id_main != "")
		{
			$("#textError").html(e.error_id_main);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3000);
		}
		
		if(typeof(e.error_id_menu) != "undefined" && e.error_id_menu != "")
		{
			$("#textError").html(e.error_id_menu);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3000);
		}
	},"json");
}