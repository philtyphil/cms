$(document).ready(function()
{
        
	$(window).load(function()
	{	/** 
        * --------------------------------- 
        * Show When window loaded - philtyphil
        * ---------------------------------
        **/
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow");
		
	 $('.summernote').summernote({height: 300, focus: true,codemirror: { theme: 'monokai'}});
	
	});
	 $('#tags_1').tagsInput({width:'auto'});
	 
	 $(".chzn-select").chosen();
});



function savingdata()
{
	var tag = $("#tags_1").val();
	var tagsInput = tag.replace(new RegExp(",", 'g'), "|");

	url = base_url+"berita/saveAddBerita";
	data = {
		judul 		: $("#judulberitaPhiltyphil").val(),
		isi_berita 	: $("#isi_berita").code(),	
		kategori 	: $("#kategori").val(),
		tags		: tagsInput,
		gambar		: $("#photoImg").val(),
		submit		: "submit"
	}
	$.ajax({
	type: "POST",
	url: url,
	data: data,
	dataType: "JSON",
	success: function(e)
	{
		if(typeof(e.success) != "undefined" && e.success != "")
		{
			$("#loading").fadeIn("slow");
			var FormDatas = new FormData();
			jQuery.each($('#photoImg')[0].files, function(i, file) {
				FormDatas.append('file-'+i, file);
			});
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4) {
					data = xhr.responseText;
					if(data.length > 1)
					{
						imagebw(FormDatas);
					}
				}
			}
			xhr.open('POST', base_url+"berita/uploadImage", true);
			xhr.send(FormDatas);
			
		}
		else if(typeof(e.failure) != "undefined" && e.failure != "")
		{
			$("#writeErrorAddOnjQuery").html(e.failure);
			$("#addError").fadeIn("slow");
			setTimeout(function()
			{
				$("#addError").fadeOut("slow");
			},3600);
		}
		else if(typeof(e.error_isi_berita) != "undefined" && e.error_isi_berita != "")
		{
			$("#writeErrorAddOnjQuery").html(e.error_isi_berita);
			$("#addError").fadeIn("slow");
			setTimeout(function()
			{
				$("#addError").fadeOut("slow");
			},3600);
		}
		else if(typeof(e.error_judul) != "undefined" && e.error_judul != "")
		{
			$("#writeErrorAddOnjQuery").html(e.error_judul);
			$("#addError").fadeIn("slow");
			setTimeout(function()
			{
				$("#addError").fadeOut("slow");
			},3600);
		}
		else if(typeof(e.error_tags) != "undefined" && e.error_tags != "")
		{
			$("#writeErrorAddOnjQuery").html(e.error_tags);
			$("#addError").fadeIn("slow");
			setTimeout(function()
			{
				$("#addError").fadeOut("slow");
			},3600);
		}
	}
	});
	
	
}

function imagebw(FormDatas)
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			data = xhr.responseText;
			if(data.length > 1)
			{
				imagesinglepost(FormDatas);
			}
		}
	}
	xhr.open('POST', base_url+"berita/uploadImageBW", true);
	xhr.send(FormDatas);
}

function imagesinglepost(FormDatas)
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4) {
			data = xhr.responseText;
			if(data.length > 1)
			{
				$("#loading").fadeOut("slow"); 
				window.location.href= base_url +"berita";
			}
		}
	}
	xhr.open('POST', base_url+"berita/uploadImageSinglePost", true);
	xhr.send(FormDatas);
}

