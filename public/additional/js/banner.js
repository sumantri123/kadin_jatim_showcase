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
		location.href = "/addBanner";	

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
		var action_url = "" + base_url + "/saveBanner";
		var action_type = "Tambah";
		if (method === "PUT") {
			action_url = "" + base_url + "/updateBanner/" + $('#id').val();
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
					location.href = "/banner";							
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
                "url": "" + base_url + '/getDataJson/banner',
                'type': 'GET',
                'dataType': 'JSON',
                'error': function (xhr, textStatus, ThrownException) {                    
                    error_noti('Error loading data. Exception: ' + ThrownException + "\n" + textStatus);
                }
            },

            columns: [
            {
                title: "Aksi",
                data: "	banner_id",
                width: "10%",
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
                title: "Deskripsi",                
                width: "30%",
                visible: true,
                sortable: true,                
				render: function (data, type, row) {
					return row.banner_deskripsi;                    
                }
            }, {
                title: "Status",                
                visible: true,
                sortable: true,
                width: "10%",
                class: "",
                render: function (data, type, row) {
					/* if (row.berita_publish === "y") {
                        return '<input type="checkbox" data-render="switchery" data-theme="default" checked />';
                    } else {            
                        return '<input type="checkbox" data-render="switchery" data-theme="default" />';
                    } */
					
                    if (row.banner_publish === "y") {
						return '<button onclick="updateStatus('+row.banner_id+","+"'n'"+","+"'/updateStatusBanner'"+')" class="btn btn-success btn-sm btn-akses"> <i class="fa fa-eye"></i> Publish</button>&nbsp;';
                        //return '<span class="label label-success">Publish</span>';
                    } else {            
						return '<button onclick="updateStatus('+row.banner_id+","+"'y'"+","+"'/updateStatusBanner'"+')" class="btn btn-danger btn-sm btn-akses"> <i class="fa fa-eye-slash"></i> Tidak Publish</button>&nbsp;';
                        //return '<span class="label label-danger">Tidak Publish</span>';
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
					if (row.banner_path === "" || row.banner_path === null || row.banner_path === "null") {						
						result += '<div id="galleryx" class="gallery" style="width:200px; height:120px">';
						result += '<a href="'+base_url+'/frontend/assets_new/images/123.jpg" data-lightbox="gallery-group-1">';
						result += '<img src="'+base_url+'/frontend/assets_new/images/123.jpg" style="width:200px; height:120px"/></a>';
						result += '</div>';
					} else {
						result += '<div id="gallery" class="gallery" style="width:200px; height:120px">';
						result += '<a href="'+base_url+'/'+row.banner_path+row.banner_name+'" data-lightbox="gallery-group-1">';
						result += '<img src="'+base_url+'/'+row.banner_path+row.banner_name+'" style="width:200px; height:120px"/></a>';
						result += '</div>';
					}
                    return result;
                }
            }],

            "drawCallback": function (settings) {
                $('.btn-edit').on('click', function () {                    
                    var data = data_table.row($(this).parents('tr')).data();
					location.href = "/editBanner/"+btoa(data.banner_id);	                                       
                });

                $('.btn-delete').on('click', function () {
                    var data = data_table.row($(this).parents('tr')).data();
                    Lobibox.confirm({
                        iconClass: true,
                        title: 'Delete Data',                        
                        msg: 'Yakin Hapus Data "' + data.banner_deskripsi + '"?',
                        callback: function ($this, type, ev) {
                            if(type=='yes'){
								var route = "/delete/banner/";
                                deleteProses(data.banner_id,route);
                            }        
                        }
                    });
                });
            }
		});            
    }    

    var validator = $('#data_form').validate({

        rules: {
            banner_deskripsi: { required: true },
			banner_publish: {required: true},			            			
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