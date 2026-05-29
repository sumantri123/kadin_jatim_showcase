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
		location.href = "/addFile";	

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

		if(this.files[0].size > 10000000) {            

			error_noti('Please upload file less than 2MB. Thanks!!');            
			$(this).val('');

		  } else {

			switch (ext) {
				case 'pdf':
				case 'PDF':
				case 'doc':
				case 'docx':				
				case 'DOC':
				case 'DOCX':				
				case 'ppt':
				case 'PPT':        
				case 'pptx':        
				case 'PPTX':        
					$('#btnUpload').attr('disabled', false);
					break;
				default:
					error_noti('File Yang Diperbolehkan Hanya Extension pdf, doc / ppt');            
					this.value = '';
			}
			
		  }    
	});

    
	$('#data_form').submit(function(e) {
		e.preventDefault();
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/saveFile";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateFile/" + $('#id').val();
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
					location.href = "/file";							
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
                "url": "" + base_url + '/getDataJson/file',
                'type': 'GET',
                'dataType': 'JSON',
                'error': function (xhr, textStatus, ThrownException) {                    
                    error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
                }
            },

            columns: [
            {
                title: "Aksi",
                data: "	file_id",
                width: "15%",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
                    result +=
                        '<button class="btn btn-warning btn-sm btn-edit"> <i class="fa fa-pencil-alt"></i> </button>&nbsp;';
                    result +=
                        '<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
                    result += '</td>';
                    return result;
                }
            },
			{
                title: "Nama File",                
                width: "30%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.file_title;                    
                }
            }, {
                title: "Status",                
                visible: true,
                sortable: true,
                width: "10%",
                class: "",
                render: function (data, type, row) {					
					                    
					if (row.file_publish === "y") {
						return '<button onclick="updateStatus('+row.file_id+","+"'n'"+","+"'/updateStatusFile'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
                    } else {       
						return '<button onclick="updateStatus('+row.file_id+","+"'y'"+","+"'/updateStatusFile'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';						
                    }
                }
            }, {
                title: "File",                
                visible: true,
                sortable: true,
                width: "20%",
                class: "",
                render: function (data, type, row) { 				
					var result = '';
					if (row.file_path === "" || row.file_path === null || row.file_path === "null") {						
						result += '<button class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye"></i> File Belum Diupload</button>&nbsp;';						
					} else {
						result += '<button class="btn btn-yellow btn-sm btn-file"> <i class="fa fa-eye"></i> Lihat File</button>&nbsp;';						
					}
                    return result;
                }
            }],

            "drawCallback": function (settings) {
                $('.btn-edit').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/editFile/"+btoa(data.file_id);	                                       
                });
				
				$('.btn-file').on('click', function () {
					var data = data_table.row($(this).parents('tr')).data();
					viewFile(data.file_path, data.file_name, data.file_exe);
				});
			
                $('.btn-delete').on('click', function () {
                    var data = data_table.row($(this).parents('tr')).data();
                    Lobibox.confirm({
                        iconClass: true,
                        title: 'Delete Data',                        
                        msg: 'Yakin Hapus Data "' + data.file_nama + '"?',
                        callback: function ($this, type, ev) {
                            if(type=='yes'){
								var route = "/delete/file/";
                                deleteProses(data.file_id,route);
                            }        
                        }
                    });
                });
            }
		});            
    }    

    var validator = $('#data_form').validate({

        rules: {
            file_nama: { required: true },
			file_publish: {required: true}            	
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