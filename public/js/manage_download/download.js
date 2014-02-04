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
	url = "download/save";
	data = {
		tittle_download : $("#tittle_download").val(),
		url 			: $("#link_file").val(),
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
				$("#erro").fadeOut("slow");
			},5000);
		}
		if(typeof(e.error_tittle_download) != "undefined" && e.error_tittle_download != "")
		{
			$("#errors").html(e.error_tittle_download);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},5000);
		}
		if(typeof(e.error_url) != "undefined" && e.error_url != "")
		{
			$("#errors").html(e.error_url);
			$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},5000);
		}
	},"json");
}