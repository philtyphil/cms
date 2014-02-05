$( document ).ready(function()
{
	
	$(window).load(function()
	{ 
		
		$("#loadmenu").load(base_url+"user/loadmenu");
		$("#loaderberita").load(base_url+"berita/loadberitalist");
		$("#manage_kategori").load(base_url+"berita/loadkategori");
		$("#loading").fadeOut("slow"); 
		$("#editsave").click(function(){
			saveeditberita();
		});
		$(".summernote").summernote({
			height:300,
			onImageUpload: function(files, editor, welEditable) {
				sendFile(files[0],editor,welEditable);
			}
		});
	});
	$("#edit_nama_kategori").keyup(function()
	{
		
		values = $("#edit_nama_kategori").val()
		values = values.replace(/[^a-zA-Z0-9]/g,'-');
		$("#edit_nama_kategori_SEO").val(values);
	});
	$('#tags_1').tagsInput({width:'auto'});
	
	
	/** button save click edit kategori**/
	$("#saved_kategori").click(function(){
		$("#loading").fadeIn("slow"); 
		savekategorieditberita();
	});
	
});
function sendFile(file,editor,welEditable) {
    data = new FormData();
    data.append("file", file);
	url = base_url+"berita/saveimageeditor";
    $.ajax({
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function(url) {
            editor.insertImage(welEditable, url);
        }
    });
}
function editberita(id)
{
	window.location.href= base_url+"berita/edit/"+id;
}

function saveeditberita()
{

	var tag = $("#tags_1").val();
	var tags = tag.replace(new RegExp(",", 'g'), ",");
	var data = {
		username	: $("#edit_username_berita").val(),
		judul		: $("#edit_judul_berita").val(),
		last_edit	: $("#edit_tanggal").val(),
		id_berita	: $("#edit_id").val(),
		gambar		: $("#photoImg").val(),
		isi_berita	: $("#editor1").code(),
		tag			: tags,
		submit		: "submit"
	};
	
	var url = base_url+"berita/saveedit";
	$.post(url,data,function(data){
		if(data.sucess != "" && typeof(data.success) != "undefined")
		{
			if($("#photoImg").val() != ""){
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
			else
			{
				window.location.href = base_url + "berita";
			}
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

function editkategoriberita(id)
{
	window.location.href=base_url+"berita/actionkategori/edit/"+id;
}

function savekategorieditberita()
{
	var url=base_url+"berita/saveberitakategori";
	var data = {
		id_kategori 		: $("#id_kategori_edit").val(),
		nama_kategori		: $("#edit_nama_kategori").val(),
		nama_kategori_seo	: $("#edit_nama_kategori_SEO").val(),
		aktif				: $("input[name='aktif']:radio").val(),
		action				: "edit",
		submit				: "submit"
	};
	$.post(url,data,function(data){
		if(data.success != "" && typeof(data.success) != "undefined")
		{
			$("#loading").fadeOut();
			$("#success").fadeIn("slow");
		}
		
		if(data.error_nama_kategori != "" && typeof(data.error_nama_kategori) != "undefined")
		{
			$("#loading").fadeOut();
			$("#error_notif").html(data.error_nama_kategori);$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3500);
			
		}
		if(data.error_nama_kategori_seo != "" && typeof(data.error_nama_kategori_seo) != "undefined")
		{
			$("#loading").fadeOut();
			$("#error_notif").html(data.error_nama_kategori_seo);$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3500);
			
		}
		if(data.error_nama_kategori_seo != "" && typeof(data.error_nama_kategori_seo) != "undefined")
		{
			$("#loading").fadeOut();
			$("#error_notif").html(data.error_nama_kategori_seo);$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3500);
			
		}
		if(data.error_aktif != "" && typeof(data.error_aktif) != "undefined")
		{
			$("#loading").fadeOut();
			$("#error_notif").html(data.error_aktif);$("#error").fadeIn("slow");
			setTimeout(function(){
				$("#error").fadeOut("slow");
			},3500);
			
		}
		
	},"json");
}

function deletekategoriberita(id)
{
	$("#ModalConfirm").attr("rel",id);
	$("#ModalConfirm").modal({backdrop:false,show:true});
}

function deleting_kategori()
{
	var data = {id : $("#ModalConfirm").attr("rel")};
	var url = base_url + "berita/deletekategori/";
	$.post(url,data,function(data){
		if(data)
		{
			alert("sukses");
		}
	},json);
	
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
				alert("Update Blog Success!!");
				window.location.href= base_url +"berita";
			}
		}
	}
	xhr.open('POST', base_url+"berita/uploadImageSinglePost", true);
	xhr.send(FormDatas);
}
