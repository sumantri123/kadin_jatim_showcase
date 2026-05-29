var data_table;

$(document).ready(function () {		
	$('.daftar_modal').on('click', function () {			
		clearModal();
		var id = $(this).data('id');
		$(".modal-body #idAgenda").val( id );
    });
	
    $('button#btnDaftar').on('click', function () {							
		insert();
    });
         
});
	
function insert() {

	var form = $('#form_tambah');
	if (form.valid() == true) {
		
		var method = $('#method_field').val();
		var action_url = "" + base_url + "/savePeserta";            
		var action_type = "Tambah";		

		$.ajax({
			type: 'POST',
			url: action_url,
			dataType: 'JSON',
			data: form.serialize(),                

			success: function (data) {
				if (data.status == 'insert_successful') {
					anim5_noti('Pendaftaran Anda Sudah Berhasil');					
					$('.modal-form').modal('toggle');            
                    clearModal(); 
					
				} else if (data.status == 'insert_failed') {
					anim4_noti('Pendaftaran Anda Gagal'); 
					$('.modal-form').modal('toggle');            
                    clearModal(); 
					var errors = data.error;
					errorValidationLaravel(errors, '#error-validation');
						

				} else if (data.status == 'double') {
					$('.modal-form').modal('toggle');            
                    clearModal(); 
					anim2_noti('Anda Sudah Terdaftar Dalam Agenda Ini'); 					
				} else {
					anim4_noti('Pendaftaran Anda Gagal');					
					$('.modal-form').modal('toggle');            
                    clearModal(); 
				}
			},

			error: function (xmlhttprequest, textstatus, message) {
				anim4_noti('Koneksi Ke Server Gagal, '+message);
			}

		});		
	} else {                        		
		anim4_noti('Mohon Isi Form Dengan Lengkap, Cek Input Form Yang Berwarna Merah');
	}
}
	
var validator = $('#form_tambah').validate({

	rules: {
		daftar_nama: {
			required: true
		},

		daftar_alamat: {
			required: true,
		},			
		
		daftar_email: {
			required: true,
		},			
		
		daftar_hp: {
			required: true,
		},			

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