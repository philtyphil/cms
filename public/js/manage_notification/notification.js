$(document).ready(function()
{
	$(window).load(function()
	{
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
	});
});

function save()
{
	url = "notification/save";
	data = {
		notification : $("#Notification").val(),
		submit			: "submit"
	};
	$.post(url,data,function(e){
		if(typeof(e.success) != "undefined" && e.success != "")
		{
			$("#success").fadeIn("slow");
			setTimeout(function(){
				$("#success").fadeOut("slow");
			},6000);
		}
		if(typeof(e.failed) != "undefined" && e.failed != "")
		{
			$("#errors").html(e.failed);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},5000);
		}
		if(typeof(e.error_notification) != "undefined" && e.error_notification != "")
		{
			$("#errors").html(e.error_notification);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},5000);
		}
	
	},"json");
}