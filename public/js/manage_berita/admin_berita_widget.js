$( document ).ready(function()
{
	
	$(window).load(function()
	{ 
		
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loading").fadeOut("slow"); 
		CKEDITOR.on('instanceReady', function(ev) {
			ev.editor.on('paste', function(evt) { 
			evt.data.dataValue = evt.data.dataValue.replace("/&nbsp;/g",'');
			evt.data.dataValue = evt.data.dataValue.replace("/<p><\/p>/g",'');
			console.log(evt.data.dataValue);
		}, null, null, 9);
		});
	});

	$("#editsave").click(function(){
		saveeditberita();
	});
	$('#tags_1').tagsInput({width:'auto'});
});

function editberita(id)
{
	window.location.href= base_url+"berita/edit/"+id;
}

function saveeditberita()
{
	var tag = $("#tags_1").val();
	var tags = tag.replace(new RegExp(",", 'g'), "|");
	var data = {
		username	: $("#edit_username_berita").val(),
		judul		: $("#edit_judul_berita").val(),
		last_edit	: $("#edit_tanggal").val(),
		id_berita	: $("#edit_id").val(),
		gambar		: $("#photoImg").val(),
		isi_berita	: CKEDITOR.instances.editor1.getData(),
		tag			: tags,
		submit		: "submit"
	};
	
	var url = base_url+"berita/saveedit";
	$.post(url,data,function(data){
		if(data.sucess != "" && typeof(data.success) != "undefined")
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
		if(data.error_isi_berita != "" && typeof(data.error_isi_berita) != "undefined")
		{
			$("#menu_edit_berita").addClass("error");
			$("#error_edit_berita").html(data.error_isi_berita);
			setTimeout(function(){
				$("#menu_edit_berita").removeClass("error");
				$("#error_edit_berita").html("");
			},5000);
		}
		else if(data.error_judul != "" && typeof(data.error_judul) != "undefined")
		{
			$("#menu_edit_judul").addClass("error");
			$("#error_judul").html(data.error_judul);
			setTimeout(function(){
				$("#menu_edit_judul").removeClass("error");
				$("#error_judul").html("");
			},5000);
		}
		else if(data.error_last_edit != "" && typeof(data.error_last_edit) != "undefined")
		{
			$("#menu_edit_tanggal_edit").addClass("error");
			$("#error_tanggal_edit").html(data.error_last_edit);
			setTimeout(function(){
				$("#menu_edit_tanggal_edit").removeClass("error");
				$("#error_tanggal_edit").html("");
			},5000);
		}
	},"json");
}

function deleteberita(id)
{
	url = base_url +"berita/del/"+id;
	$.getJSON(url,function(data){
		if(data.success != "" && typeof(data.success) != "undefined")
		{
			$("#loaderberita").load(base_url+"berita/loadberitalist");
		}
	});

}

function savingdatakategori(idkategori)
{
	var tag = $("#tags_1").val();
	var tagsInput = tag.replace(new RegExp(",", 'g'), "|");

	url = base_url+"berita/saveAddWidget";
	data = {
		judul 		: $("#judulberitaPhiltyphil").val(),
		isi_berita 	: CKEDITOR.instances.berita.getData(),
		tags		: tagsInput,
		id_kategori	: idkategori,
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
		else if(typeof(e.error_kategori) != "undefined" && e.error_kategori != "")
		{
			$("#writeErrorAddOnjQuery").html(e.error_kategori);
			$("#err_kategori").html(e.error_kategori);
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
			}
		}
	}
	xhr.open('POST', base_url+"berita/uploadImageSinglePost", true);
	xhr.send(FormDatas);
}
