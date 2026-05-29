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
    /* $('button#tambah').on('click', function () {					
		location.href = "/addKb";	

    }); */
	
	$('button#tambah_new').on('click', function () {					
		$('#modal').modal('show');

    });
	
	$('button#btn_simpan').on('click', function () {        
        insertUpdateProses();
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

    function insertUpdateProses() {

        var form = $('#data_form');
        if (form.valid() == true) {
            
            var method = $('#method_field').val();
            var action_url = "" + base_url + "/saveKb";            
            var action_type = "Tambah";
            if (method === "PUT") {
                action_url = "" + base_url + "/updateKb/" + $('#id').val();
                action_type = "Ubah";
            }

            $.ajax({
                type: 'POST',
                url: action_url,
                dataType: 'JSON',
                data: form.serialize(),                

                success: function (data) {
                    if (data.status == 'insert_successful') {
                        success_noti('Berhasil ' + action_type + ' Data');
                        $('.modal-form').modal('toggle');
                        data_table.ajax.reload(null, false);
                    } else if (data.status == 'insert_failed') {
                        error_noti('Gagal ' + action_type + ' Data'); 

                        var errors = data.error;
                        errorValidationLaravel(errors, '#error-validation');


                    } else {
                        error_noti('Gagal ' + action_type + ' (Kesalahan Sistem)');
                    }
                },

                error: function (xmlhttprequest, textstatus, message) {
                    error_noti('Koneksi Ke Server Gagal, '+message);
                }

            });            
            //sweetAlertLoading('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah',1000);
        } else {                        
            error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
        }
    }
	
	/* $('#data_form').submit(function(e) {
		e.preventDefault();
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/saveKb";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateKb/" + $('#id').val();
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
					location.href = "/kb";							
					this.reset();
					success_noti('Data Berhasil Disimpan');   										
				},
				error: function (error) {
					//error_noti(error.responseJSON.errors.file);
					error_noti("Data Gagal Disimpan");
				}
			});
		} else {
			
			error_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
		}    
	}); */


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
                "url": "" + base_url + '/getDataJson/kb',
                'type': 'GET',
                'dataType': 'JSON',
                'error': function (xhr, textStatus, ThrownException) {                    
                    error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
                }
            },

            columns: [
            {
                title: "Aksi",
                data: "	kategori_id",
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
            },{
				title: "No",			
				width: "5%",
				visible: true,
				sortable: true,                
				render: function (data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				}
			},{
                title: "Kategori Berita",                
                width: "40%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.kategori_nama;                    
                }
            },{
                title: "Status",                
                visible: true,
                sortable: true,
                width: "40%",
                class: "",
                render: function (data, type, row) {
					if (row.kategori_status === "y") {
						return '<button onclick="updateStatus('+row.kategori_id+","+"'n'"+","+"'/updateStatusKb'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
                    } else {       
						return '<button onclick="updateStatus('+row.kategori_id+","+"'y'"+","+"'/updateStatusKb'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';						
                    }										
                }
            }],

            "drawCallback": function (settings) {
                $('.btn-edit').on('click', function () {                    
					clearModal();
                    var data = data_table.row($(this).parents('tr')).data();
                    $('#id').val(btoa(data.kategori_id));
                    $('#sektor_nama').val(data.kategori_nama);					

                    $('#modal_label').text('Form Ubah');
                    $('#method_field').val("PUT");
                    $(".modal-form").modal('show');					                    
                });

                $('.btn-delete').on('click', function () {
                    var data = data_table.row($(this).parents('tr')).data();
                    Lobibox.confirm({
                        iconClass: true,
                        title: 'Delete Data',                        
                        msg: 'Yakin Hapus Data "' + data.kategori_nama + '"?',
                        callback: function ($this, type, ev) {
                            if(type=='yes'){
								var route = "/delete/kb/";
                                deleteProses(data.kategori_id,route);
                            }        
                        }
                    });
                });
            }
		});            
    }    

    var validator = $('#data_form').validate({

        rules: {
            kategori_nama: { required: true },
			kategori_status: {required: true}			
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