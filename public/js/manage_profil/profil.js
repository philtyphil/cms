$( document ).ready(function()
{
	
	$(window).load(function()
	{ 
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
		
	});
	setTimeout(function(){
		getdesc();
	},1800);

});

function getdesc()
{
	url = base_url + "profil/getdesc";
	$.getJSON(url,function(e){
		$("#desc_saung").data("wysihtml5").editor.setValue(e[0].isi_halaman);
	});
}

function reset()
{
	$("#desc_saung").data("wysihtml5").editor.setValue("");
}

function save()
{
	data = {desc:$("#desc_saung").val(),submit: "submit"};
	url = base_url + "profil/save";
	$.post(url,data,function(data){
		if(typeof(data.notif) != "undefined" && data.notif != "")
		{
			$("#success").html(data.notif);
			$("#success_log").fadeIn("slow");
			setTimeout(function(){
				$("#success_log").fadeOut("slow");
			},5000);
		}
		if(typeof(data.error_desc) != "undefined" && data.error_desc != "")
		{
			$("#error").html(data.error_desc);
			$("#error_log").fadeIn("slow");
			setTimeout(function(){
				$("#error_log").fadeOut("slow");
			},5000);
		}
	},"json");
}

