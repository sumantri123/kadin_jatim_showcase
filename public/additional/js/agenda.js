var data_table;

$(document).ready(function () {
	var cek = $("#act").val();
	
	if(cek=="edit"){
		$( "#edit_upload" ).show();
		$( "#new_upload" ).hide();
	} else {
		$( "#edit_upload" ).hide();
		$( "#new_upload" ).show();
	}	
	
    loadData();
    $('button#tambah').on('click', function () {					
		location.href = "/addEvent";	

    });
	
	$('#delete_image').on('click', function () {		
	
		$( "#edit_upload" ).hide();
		$( "#new_upload" ).show();
		
    });
	
	$('#gallery').on('click', function () {		
	
		$( "#edit_upload" ).show();
		$( "#new_upload" ).hide();
		
    });
         
});
	
	$('INPUT[type="file"]').change(function () {
		
		var ext = this.value.match(/\.(.+)$/)[1];

		if(this.files[0].size > 2000000) {            

			error_noti('Please upload file less than 2MB. Thanks!!');            
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
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/saveEvent";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateEvent/" + $('#id').val();
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
					location.href = "/event";							
					this.reset();
					success_noti('Data Berhasil Diupload');   										
				},
				error: function (error) {
					//error_noti(error.responseJSON.errors.file);
					error_noti("Data Gagal Diupload");
				}
			});
		} else {
			
			error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
		}    
	});


	function loadData() {
		
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
                "url": "" + base_url + '/getDataJson/event',
                'type': 'GET',
                'dataType': 'JSON',
                'error': function (xhr, textStatus, ThrownException) {                    
                    error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
                }
            },

            columns: [
            {
                title: "Aksi",
                data: "agenda_id",
                width: "20%",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
                    result +=
                        '<button class="btn btn-warning btn-sm btn-edit" title="Edit Data"> <i class="fa fa-pencil-alt"></i> </button>&nbsp;';
					result +=
                        '<button class="btn btn-info btn-sm btn-info" title="Daftar Peserta"> <i class="fa fa-users"></i> </button>&nbsp;';
                    result +=
                        '<button class="btn btn-danger  btn-sm btn-delete" title="Delete Data"> <i class="fa fa-trash"></i> </button>';
                    result += '</td>';
                    return result;
                }
            },
			{
                title: "Instansi",                
                width: "20%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.instansi;                    
                }
            },
			{
                title: "Nama Kegiatan",
                data: "agenda_judul",
                width: "20%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.agenda_judul;                    
                }
            }, {
                title: "Tanggal",               
                width: "10%",
                visible: true,
                sortable: true,
                class: "",
				render: function (data, type, row) {
					return row.agenda_tanggal +" "+row.agenda_waktu;                    
                }
            }, {
                title: "Status",                
                visible: true,
                sortable: true,
                width: "10%",
                class: "",
                render: function (data, type, row) {					
					
                    /* if (row.agenda_publish === "y") {
                        return '<span class="label label-success">Publish</span>';
                    } else {            
                        return '<span class="label label-danger">Tidak Publish</span>';
                    } */
					
					if (row.agenda_publish === "y") {     
						return '<button onclick="updateStatus('+row.agenda_id+","+"'n'"+","+"'/updateStatusEvent'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
						//return '<input type="checkbox" onclick="updateStatus('+row.agenda_id+","+"'n'"+","+"'/updateStatusEvent'"+')" checked data-toggle="toggle"><span class="label label-success"> Publish</span>';
                    } else {                                    
						return '<button onclick="updateStatus('+row.agenda_id+","+"'y'"+","+"'/updateStatusEvent'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';
						//return '<input type="checkbox" onclick="updateStatus('+row.agenda_id+","+"'y'"+","+"'/updateStatusEvent'"+')" data-toggle="toggle"><span class="label label-danger">Tidak Publish</span>';
                    }
                }
            }, {
                title: "Gambar",                
                visible: true,
                sortable: true,
                width: "20%",
                class: "",
                render: function (data, type, row) { 				
					var result = '';
					if (row.agenda_path === "" || row.agenda_path === "null" || row.agenda_path === null) {						
						result += '<div id="galleryx" class="gallery" style="width:200px; height:120px">';
						result += '<a href="'+base_url+'/frontend/assets_new/images/123.jpg" data-lightbox="gallery-group-1">';
						result += '<img src="'+base_url+'/frontend/assets_new/images/123.jpg" style="width:200px; height:120px"/></a>';
						result += '</div>';
					} else {
						result += '<div id="gallery" class="gallery" style="width:200px; height:120px">';
						result += '<a href="'+base_url+'/'+row.agenda_path+row.agenda_gambar_name+'" data-lightbox="gallery-group-1">';
						result += '<img src="'+base_url+'/'+row.agenda_path+row.agenda_gambar_name+'" style="width:200px; height:120px"/></a>';
						result += '</div>';
					}
                    return result;
                }
            }],

            "drawCallback": function (settings) {
                $('.btn-edit').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/editEvent/"+btoa(data.agenda_id);	                                       
                });
				
				$('.btn-info').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/infoEvent/"+btoa(data.agenda_id);	                                       
                });

                $('.btn-delete').on('click', function () {
                    var data = data_table.row($(this).parents('tr')).data();
                    Lobibox.confirm({
                        iconClass: true,
                        title: 'Delete Data',                        
                        msg: 'Yakin Hapus Data "' + data.agenda_judul + '"?',
                        callback: function ($this, type, ev) {
                            if(type=='yes'){
								var route = "/delete/event/";
                                deleteProses(data.agenda_id,route);
                            }        
                        }
                    });
                });
            }
		});            
    }    

    var validator = $('#data_form').validate({

        rules: {
            agenda_judul: { required: true },
			agenda_publish: {required: true},			
            datepicker: {required: true},						
			agenda_isi: {required: true},						
        },

        highlight: function (element, errorClass, validClass, error) {
            $(element.form).find("[id=" + element.id + "]").addClass('is-invalid');
            $(element.form).find("[id=" + element.id + "]").removeClass('is-valid');

        },

        unhighlight: function (element, errorClass, validClass) {
            $(element.form).find("[id=" + element.id + "]").removeClass('is-invalid');
            $(element.form).find("[id=" + element.id + "]").addClass('is-valid');
        }
    });
	
	$('.summernote').summernote({
		height: 300,   //set editable area's height
		toolbar: [
		// [groupName, [list of button]]
		['style', ['bold', 'italic', 'underline', 'clear']],
		['font', ['strikethrough', 'superscript', 'subscript']],
		['fontname', ['fontname']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		['height', ['height']],
		['table', ['table']],
		['insert', ['link', 'picture', 'video', 'hr']],
		['history', ['undo', 'redo']],
		['view', ['fullscreen', 'codeview']],
		['help',['help']]
		]
	});