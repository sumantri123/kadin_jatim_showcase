var data_table;
$(document).ready(function () {
	loadData();
});

$('INPUT[type="file"]').change(function () {
		
	var ext = this.value.match(/\.(.+)$/)[1];

	if(this.files[0].size > 5000000) {            

		error_noti('Please upload file less than 5MB. Thanks!!');            
		$(this).val('');

	} else {

		switch (ext) {
			case 'jpg':
			case 'JPG':        
			case 'jpeg':
			case 'JPEG':        
			case 'png':        
			case 'PNG':        
				$('#btnUpload').attr('disabled', false);
				break;
			default:
				error_noti('File Yang Diperbolehkan Hanya Extension jpg / png');            
				this.value = '';
		}
		
	  }    
});


$('#data_form').submit(function(e) {
	e.preventDefault();
	
	var cekfile = $('input[type=file]').val();
	
	if(cekfile===""){
		
		warning_noti('Anda Belum Upload File');
		
	} else {
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/saveUmkmImage";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateUmkmImage/" + $('#id').val();
			action_type = "Ubah";
		}
			
		var formData = new FormData(this);        
		var form = $('#data_form');
		
		if (form.valid() == true) {    
						
			$.ajax({
				type:'POST',
				url: action_url,
				data: formData,
				cache:false,
				contentType: false,
				processData: false,
				beforeSend: function(){
					BeforeSend();
				},
				complete: function(){
					AfterSend();
				},
				success: (data) => {									
					success_noti('Data Berhasil Diupload');   	
					$("#file").val('');				
					data_table.ajax.reload(null, false);
				},
				error: function (error) {
					//error_noti(error.responseJSON.errors.file);
					error_noti("Data Gagal Diupload");
				}
			});
		} else {
			
			error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
		}    
	}	
});

function loadData() {
		
	var id = $('#id_umkm').val()
	data_table  = $('#datatable').DataTable({            
		destroy: true,
		processing: false,
		lengthChange: true,
		initComplete: function() {
			data_table.buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
			$("#datatable").show();
		},
		buttons: ['copy', 'excel', 'pdf', 'print', 'colvis'],
		ajax: {
			"url": "" + base_url + '/getDataJson/umkm_image/'+id,
			'type': 'GET',
			'dataType': 'JSON',
			'error': function (xhr, textStatus, ThrownException) {                    
				error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
			}
		},

		columns: [
		{
			title: "Aksi",
			data: "umkm_image_id",
			width: "10%",
			visible: true,
			sortable: false,
			class: "text-center",
			render: function (data, type, full, meta) {
				var result = '';
				result += '<td class="text-center">';
				result +=
					'<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
				result += '</td>';
				return result;
			}
		},{
			title: "Nama File",
			data: "umkm_image_ori",
			width: "50%",
			visible: true,
			sortable: true,                
			render: function (data, type, row) {
				return row.umkm_image_ori;                    
			}
		},{
			title: "Gambar",                
			visible: true,
			sortable: true,
			width: "15%",
			class: "",
			render: function (data, type, row) { 				
				var result = '';
				if (row.umkm_image_path === "" || row.umkm_image_path === null || row.umkm_image_path === "null") {						
					result += '<div id="galleryx" class="gallery" style="width:200px; height:120px">';
					result += '<a href="'+base_url+'/frontend/assets_2/images/123.jpg" data-lightbox="gallery-group-1">';
					result += '<img src="'+base_url+'/frontend/assets_new/images/123.jpg" style="width:200px; height:120px"/></a>';
					result += '</div>';
				} else {
					result += '<div id="gallery" class="gallery" style="width:200px; height:120px">';
					result += '<a href="'+base_url+'/'+row.umkm_image_path+row.umkm_image_name+'" data-lightbox="gallery-group-1">';
					result += '<img src="'+base_url+'/'+row.umkm_image_path+row.umkm_image_name+'" style="width:200px; height:120px"/></a>';
					result += '</div>';
				}
				return result;
			}
		},{
			title: "Status",                
			visible: true,
			sortable: true,
			width: "10%",
			class: "",
			render: function (data, type, row) {										                    
				
				if (row.umkm_image_publish === "y") {
					return '<button onclick="updateStatus('+row.umkm_image_id+","+"'n'"+","+"'/updateStatusUmkmImage'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
				} else {       
					return '<button onclick="updateStatus('+row.umkm_image_id+","+"'y'"+","+"'/updateStatusUmkmImage'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';						
				}
			}
		}],

		"drawCallback": function (settings) {		

			$('.btn-delete').on('click', function () {				
				var data = data_table.row($(this).parents('tr')).data();
				Lobibox.confirm({
					iconClass: true,
					title: 'Delete Data',                        
					msg: 'Yakin Hapus Data ?',
					callback: function ($this, type, ev) {
						if(type=='yes'){
							var route = "/delete/umkm_image/";
							deleteProses(data.umkm_image_id,route);
						}        
					}
				});
			});
		}
	});            
}    

