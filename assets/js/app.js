$(function(){

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});

	$('#tanggal_lahir').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
	});

	$('#btn-logout').on('click', function(){
		$.ajax({
			url: '/app/auth/logout.php',
			method: 'POST',
			dataType: 'JSON',
			success: function(data){
				if (data.status == 'OK'){
					swal({
						title: 'Success!',
						text: data.message,
						type: 'success',
						showConfirmButton: false,
						timer: 2000
					}).then((result) => {
						if (result.dismiss){
							window.location = data.url;
						}
					});
				} else{
					swal({
						title: 'Error!',
						text: data.message,
						type: 'error',
						confirmButtonText: 'OKE'
					});
				}
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
			}
		});
	});

	$('#form-profile').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '/app/profile/edit-profile.php',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-profile').prop('disabled', 'disabled');
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				if (data.status == 'OK'){
					swal({
						title: 'Success!',
						text: data.message,
						type: 'success',
						showConfirmButton: false,
						timer: 2000
					}).then((result) => {
						if (result.dismiss){
							location.reload();
						}
					});
				} else{
					swal({
						title: 'Error!',
						text: data.message,
						type: 'error',
						confirmButtonText: 'OKE'
					});
				}
				$('#btn-profile').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-profile').removeAttr('disabled');
			}
		});
	});

	$('#table-data-supir').DataTable();

	$('#btn-tambah-supir').on('click', function(){
		$('#sopirFormModalLabel').text('Form Input Supir Baru');
		$('#form-supir').trigger('reset');
		$('#aksi').val('tambah');
		$('#sopirFormModal').modal('show');
	});

	$('#form-supir').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/supir/tambah-supir.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/supir/ubah-supir.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-supir').prop('disabled', 'disabled');
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				if (data.status == 'OK'){
					swal({
						title: 'Success!',
						text: data.message,
						type: 'success',
						showConfirmButton: false,
						timer: 2000
					}).then((result) => {
						if (result.dismiss){
							location.reload();
						}
					});
				} else{
					swal({
						title: 'Error!',
						text: data.message,
						type: 'error',
						confirmButtonText: 'OKE'
					});
				}
				$('#btn-supir').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-supir').removeAttr('disabled');
			}
		});
	});

	$('#table-data-mobil').DataTable();

	$('#supir_id').select2({
		dropdownParent: $("#mobilFormModal"),
		theme: 'bootstrap4',
		placeholder: "Pilih Supir",
	});

	$('#btn-tambah-mobil').on('click', function(){
		$('#mobilFormModalLabel').text('Form Input Mobil Baru');
		$('#form-mobil').trigger('reset');
		$('#aksi').val('tambah');
		$('#supir_id').val('').trigger('change');
		$('#mobilFormModal').modal('show');
	});

	$('#form-mobil').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/mobil/tambah-mobil.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/mobil/ubah-mobil.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-mobil').prop('disabled', 'disabled');
			},
			data: formData,
			contentType: false,
			processData: false,
			success: function(data){
				if (data.status == 'OK'){
					swal({
						title: 'Success!',
						text: data.message,
						type: 'success',
						showConfirmButton: false,
						timer: 2000
					}).then((result) => {
						if (result.dismiss){
							location.reload();
						}
					});
				} else{
					swal({
						title: 'Error!',
						text: data.message,
						type: 'error',
						confirmButtonText: 'OKE'
					});
				}
				$('#btn-supir').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-mobil').removeAttr('disabled');
			}
		});
	});

});

// KELOLA DATA SUPIR

function getDataSupir(id) {
	$.ajax({
		url: '/app/supir/get-data-supir.php',
		method: 'POST',
		dataType: 'JSON',
		data: {
			uid: id
		},
		success: function(data){
			$('#sopirFormModalLabel').text('Form Ubah Data Supir');
			$('#form-supir').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#ktp_no').val(data.data.ktp_no);
			$('#sim_no').val(data.data.sim_no);
			$('#nama').val(data.data.nama);
			$('#jenis_kelamin option[value='+data.data.jenis_kelamin+']').attr('selected', 'selected');
			$('#tempat_lahir').val(data.data.tempat_lahir);
			$('#tanggal_lahir').val(data.data.tanggal_lahir);
			$('#alamat').val(data.data.alamat);
			$('#telepon').val(data.data.telepon);
			$('#ktp_img').removeAttr('required');
			$('#sim_img').removeAttr('required');
			$('#sopirFormModal').modal('show');
		},
		error: function(error){
			swal({
				title: 'Error!',
				text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
				type: 'error',
				confirmButtonText: 'OKE'
			});
		}
	});
}

function deleteDataSupir(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data supir ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/supir/hapus-supir.php',
				method: 'POST',
				dataType: 'JSON',
				data: {
					uid: id
				},
				success: function(data){
					if (data.status == 'OK'){
						swal({
							title: 'Success!',
							text: data.message,
							type: 'success',
							showConfirmButton: false,
							timer: 2000
						}).then((result) => {
							if (result.dismiss){
								location.reload();
							}
						});
					} else{
						swal({
							title: 'Error!',
							text: data.message,
							type: 'error',
							confirmButtonText: 'OKE'
						});
					}
				},
				error: function(error){
					swal({
						title: 'Error!',
						text: 'Mohon maaf telah terjadi sebuah kesalahan.',
						type: 'error',
						confirmButtonText: 'OKE'
					});
				}
			});
		}
	});
}

function getDataMobil(id) {
	$.ajax({
		url: '/app/mobil/get-data-mobil.php',
		method: 'POST',
		dataType: 'JSON',
		data: { uid: id },
		success: function(data){
			$('#mobilFormModalLabel').text('Form Ubah Data Mobil');
			$('#form-mobil').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#supir_id').val(data.data.supir_id).trigger('change');
			$('#plate').val(data.data.plate);
			$('#merk').val(data.data.merk);
			$('#jenis').val(data.data.jenis);
			$('#gross').val(data.data.gross);
			$('#foto').removeAttr('required');
			$('#mobilFormModal').modal('show');
		},
		error: function(error){
			swal({
				title: 'Error!',
				text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
				type: 'error',
				confirmButtonText: 'OKE'
			});
		}
	});
}

function deleteDataMobil(id) {

}