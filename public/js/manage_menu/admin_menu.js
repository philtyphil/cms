$(document).ready(function()
{
	$(window).load(function()
	{
		$("#loadermenu").load(base_url+"menu/loadmenulist");
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loadermenuwebsite").load(base_url+"menu/loadmenuwebsitelist");
	
		$("#loading").fadeOut("slow"); 
	});
});


function deletemenu(id)
{

	var data 	= {key:id};
	var url 	= base_url+"menu/deletemenu";
	$.post(url,data,function(data){
		$("#loadermenu").load(base_url+"menu/loadmenulist");
	},"json");
}

function deletemenuwebsite(id)
{
	url = base_url + "menu/deletemenuwebsite/"+id;
	$.getJSON(url,function(data)
	{
		if(typeof(data.success) != "undefined" && data.success != "")
		{
			alert(data.success);
			$("#loadermenuwebsite").load(base_url+"menu/loadmenuwebsitelist");
		}
		if(typeof(data.failed) != "undefined" && data.failed != "")
		{
			alert(data.failed);
		}
	});
}
function deletesub(id)
{
	var data 	= {key:id};
	var url 	= base_url+"menu/deletesubmenu";
	$.post(url,data,function(data){
		$("#loadermenu").load(base_url+"menu/loadmenulist");
	},"json");
}

function deletesubwebsite(id)
{

	var data 	= {key:id};
	var url 	= base_url+"menu/deletesubmenuwebsite";
	$.post(url,data,function(data){
		if(data)
		{
			$("#loadermenuwebsite").load(base_url+"menu/loadmenuwebsitelist");
		}
		else
		{
			alert("Deleting data failed!!!");
		}
	},"json");
}