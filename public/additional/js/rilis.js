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
		location.href = "/addRilis";	

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
		var action_url = "" + base_url + "/saveRilis";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateRilis/" + $('#id').val();
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
					location.href = "/rilis";							
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
                "url": "" + base_url + '/getDataJson/rilis',
                'type': 'GET',
                'dataType': 'JSON',
                'error': function (xhr, textStatus, ThrownException) {                    
                    error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
                }
            },

            columns: [
            {
                title: "Aksi",
                data: "rilis_id",
                width: "20%",
                visible: true,
                sortable: false,
                class: "text-center",
                render: function (data, type, full, meta) {
                    var result = '';
                    result += '<td class="text-center">';
					result +=
                        '<button class="btn btn-info btn-sm btn-upload"> <i class="fa fa-images"></i> </button>&nbsp;';
                    result +=
                        '<button class="btn btn-warning btn-sm btn-edit"> <i class="fa fa-pencil-alt"></i> </button>&nbsp;';
                    result +=
                        '<button class="btn btn-danger  btn-sm btn-delete"> <i class="fa fa-trash"></i> </button>';
                    result += '</td>';
                    return result;
                }
            },
			{
                title: "Berita",
                data: "rilis_judul",
                width: "45%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return 'Judul : '+row.rilis_judul;                    
                }
            }, {
                title: "Sektor",
                data: "kategori_nama",
                width: "20%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.kategori_nama;                    
                }
            },{
                title: "Jumlah Gambar",
                data: "jumlah",
                width: "20%",
                visible: true,
                sortable: true,
                class: "",
				render: function (data, type, row) {
					if (row.jumlah > 0) {
						return row.jumlah;                    
						
					}	else {
						var result = "";
						result += '<div class="alert alert-info fade show text-center">';						
						result += '<strong>Info! </strong><br>';
						result += 'Belum Upload Gambar </div>';
						
						return result; 
					}				
                }
            },{
                title: "Tanggal",
                data: "rilis_tanggal",
                width: "15%",
                visible: true,
                sortable: true,
                class: ""
            }, {
                title: "Status",                
                visible: true,
                sortable: true,
                width: "10%",
                class: "",
                render: function (data, type, row) {					
					
					if (row.rilis_publish === "y") {
						return '<button onclick="updateStatus('+row.rilis_id+","+"'n'"+","+"'/updateStatusRilis'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
						//return '<input type="checkbox" onclick="updateStatus('+row.berita_id+","+"'n'"+","+"'/updateStatusBerita'"+')" checked data-toggle="toggle"><span class="label label-success"> Publish</span>';
                    } else {
						return '<button onclick="updateStatus('+row.rilis_id+","+"'y'"+","+"'/updateStatusRilis'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';
						//return '<input type="checkbox" onclick="updateStatus('+row.berita_id+","+"'y'"+","+"'/updateStatusBerita'"+')" data-toggle="toggle"><span class="label label-danger">Tidak Publish</span>';
                    }
                }
            }],

            "drawCallback": function (settings) {
				$('.btn-upload').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/uploadRilis/"+btoa(data.rilis_id);	                                       
                });
				
                $('.btn-edit').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/editRilis/"+btoa(data.rilis_id);	                                       
                });

                $('.btn-delete').on('click', function () {
                    var data = data_table.row($(this).parents('tr')).data();
                    Lobibox.confirm({
                        iconClass: true,
                        title: 'Delete Data',                        
                        msg: 'Yakin Hapus Data "' + data.rilis_judul + '"?',
                        callback: function ($this, type, ev) {
                            if(type=='yes'){
								var route = "/delete/rilis/";
                                deleteProses(data.rilis_id,route);
                            }        
                        }
                    });
                });
            }
		});            
    }    

    var validator = $('#data_form').validate({

        rules: {
            berita_judul: { required: true },
			berita_publish: {required: true},			
            datepicker: {required: true},						
			berita_isi: {required: true},						
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