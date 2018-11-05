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

	$('#form-ubah-password').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '/app/password/ubah-password.php',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-password').prop('disabled', 'disabled');
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
							$('#form-ubah-password').trigger('reset');
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
				$('#btn-password').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-password').removeAttr('disabled');
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

	$('#btn-tambah-mobil').on('click', function(){
		$('#mobilFormModalLabel').text('Form Input Mobil Baru');
		$('#form-mobil').trigger('reset');
		$('#aksi').val('tambah');
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
				$('#btn-mobil').removeAttr('disabled');
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

	$('#table-data-kebun').DataTable();

	$('#btn-tambah-kebun').on('click', function(){
		$('#kebunFormModalLabel').text('Form Input Kebun Sawit Baru');
		$('#form-kebun').trigger('reset');
		$('#aksi').val('tambah');
		$('#supir_id').val('').trigger('change');
		$('#kebunFormModal').modal('show');
	});

	$('#form-kebun').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/kebun/tambah-kebun.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/kebun/ubah-kebun.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-kebun').prop('disabled', 'disabled');
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
				$('#btn-kebun').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-kebun').removeAttr('disabled');
			}
		});
	});

	$('#table-data-pelabuhan').DataTable();

	$('#btn-tambah-pelabuhan').on('click', function(){
		$('#pelabuhanFormModalLabel').text('Form Input Pelabuhan Baru');
		$('#form-pelabuhan').trigger('reset');
		$('#aksi').val('tambah');
		$('#supir_id').val('').trigger('change');
		$('#pelabuhanFormModal').modal('show');
	});

	$('#form-pelabuhan').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/pelabuhan/tambah-pelabuhan.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/pelabuhan/ubah-pelabuhan.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-pelabuhan').prop('disabled', 'disabled');
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
				$('#btn-pelabuhan').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-pelabuhan').removeAttr('disabled');
			}
		});
	});

	$('#kebun_id').select2({
		theme: 'bootstrap4',
		width: '100%',
		placeholder: "Pilih Perkebunan Sawit",
	});

	$('#pelabuhan_id').select2({
		theme: 'bootstrap4',
		width: '100%',
		placeholder: "Pilih Pelabuhan Bongkar Muat",
	});

	$('#armada_berangkat').select2({
		theme: 'bootstrap4',
		width: '100%',
		placeholder: "Pilih Armada Yang Akan Berangkat",
	});

	$('#do_tanggal').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
		minDate: new Date(),
	});

	$('#tanggal_armada').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
		minDate: new Date(),
	});

	$('#btn-tambah-armada').on('click', function(){
		var armada_id = $('#armada_berangkat').val();
		var tgl_berangkat = $('#tanggal_armada').val();
		var totalGross = $('#total_gross').html() * 1;
		var partaiKg = $('#partai_in_kg').val();
		$.ajax({
			url: '/app/supir_mobil/get-detail-armada.php',
			method: 'POST',
			dataType: 'JSON',
			data: { uid: armada_id },
			success: function(data){
				var newRow = 	'<tr>';
					newRow += 		'<input type="hidden" name="mobil_id[]" value="'+data.data.id+'">';
					newRow += 		'<td>ID:'+data.data.id+'</td>';
					newRow += 		'<td>'+data.data.plate+'</td>';
					newRow += 		'<td>'+data.data.nama+'</td>';
					newRow += 		'<td>'+tgl_berangkat+'</td>';
					newRow += 		'<td class="gross_detail">'+data.data.gross+'</td>';
					newRow += 		'<input type="hidden" name="tanggal_berangkat[]" value="'+tgl_berangkat+'">';
					newRow += 	'</tr>';

				var curent_gross = data.data.gross * 1;
				var flag = 0;

				if (!$('.gross_detail').length) {
					var total_gross = 0;
					total_gross = (total_gross * 1) + curent_gross;
					if (total_gross > partaiKg) {
						swal({
							title: 'Error!',
							text: 'Mohon maaf, total gross melebihi batas maximal pengangkutan.',
							type: 'error',
							confirmButtonText: 'OKE'
						});
					} else {
						var flag = 1;
						$('#total_gross').html(total_gross);
					}
				} else {
					var total_gross = 0;
					
					$('.gross_detail').each(function() {
						total_gross = (total_gross * 1) + ($(this).html() * 1);
					});
					total_gross = (total_gross * 1) + curent_gross;

					if (total_gross > partaiKg) {
						swal({
							title: 'Error!',
							text: 'Mohon maaf, total gross melebihi batas maximal pengangkutan.',
							type: 'error',
							confirmButtonText: 'OKE'
						});
					} else {
						var flag = 1;
						$('#total_gross').html(total_gross);
					}
				}

				if (flag == 1) {
					$('#tb-armada-berjalan tbody').prepend(newRow);
					$("#armada_berangkat>option[value='"+data.data.id+"']").attr('disabled','disabled');
					$('#armada_berangkat').select2({
						theme: 'bootstrap4',
						width: '100%',
						placeholder: "Pilih Armada Yang Akan Berangkat",
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

	$('#form-tambah-do').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '/app/do/tambah-do.php',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-tambah-do').prop('disabled', 'disabled');
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
							window.location.href = data.url;
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
				$('#btn-tambah-do').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-tambah-do').removeAttr('disabled');
			}
		});
	});

	$('#tabel-list-armada').DataTable();

	$('#table-data-do').DataTable();

	$('#partai').on('keyup', function(){
		var partai = $(this).val() * 1000;
		$('#partai_in_kg').val(partai);
	});

	$('#muat_tanggal').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
	});

	$('#bongkar_tanggal').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
	});

	$('#form-input-spb').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		$.ajax({
			url: '/app/do/input-spb.php',
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-input-spb').prop('disabled', 'disabled');
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
							window.location.href = data.url;
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
				$('#btn-input-spb').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-input-spb').removeAttr('disabled');
			}
		});
	});

	$('#table-data-supir-mobil').DataTable();

	$('#supir_id').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Supir",
	});

	$('#mobil_id').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Mobil",
	});

	$('#btn-tambah-supir-mobil').on('click', function(){
		$('#supirMobilFormModalLabel').text('Form Input Supir Mobil Baru');
		$('#form-supir-mobil').trigger('reset');
		$('#aksi').val('tambah');
		$('#supir_id').val('').trigger('change');
		$('#mobil_id').val('').trigger('change');
		$('#supirMobilFormModal').modal('show');
	});

	$('#form-supir-mobil').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/supir_mobil/tambah-supir-mobil.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/supir_mobil/ubah-supir-mobil.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-supir-mobil').prop('disabled', 'disabled');
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
				$('#btn-supir-mobil').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-supir-mobil').removeAttr('disabled');
			}
		});
	});

	$('#supir_mobil_id').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Armada",
	});

	$('#bulan').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Bulan",
	});

	$('#tahun').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Tahun",
	});

	$('#kendala').select2({
		theme: 'bootstrap4',
		placeholder: "Pilih Kendala",
	});

	$('#tanggal').datepicker({
		language: 'en',
		dateFormat: 'yyyy-mm-dd',
		autoClose: true,
	});

	$('#btn-tambah-kendala').on('click', function(){
		$('#kendalaFormModalLabel').text('Form Input Kendala Baru');
		$('#form-kendala').trigger('reset');
		$('#aksi').val('tambah');
		$('#supir_mobil_id').val('').trigger('change');
		$('#kendalaFormModal').modal('show');
	});

	$('#form-kendala').on('submit', function(e){
		e.preventDefault();
		var formData = new FormData(this);
		var aksi = $('#aksi').val();
		var target_url = '';
		if (aksi == 'tambah'){
			target_url = '/app/kendala/tambah-kendala.php';
		} else if (aksi == 'ubah'){
			target_url = '/app/kendala/ubah-kendala.php';
		}
		$.ajax({
			url: target_url,
			method: 'POST',
			dataType: 'JSON',
			beforeSend: function(){
				$('#btn-kendala').prop('disabled', 'disabled');
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
				$('#btn-kendala').removeAttr('disabled');
			},
			error: function(error){
				swal({
					title: 'Error!',
					text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
					type: 'error',
					confirmButtonText: 'OKE'
				});
				$('#btn-kendala').removeAttr('disabled');
			}
		});
	});

	$('#btn-cetak-pendapatan-supir').on('click', function(){
		var supir_mobil_id = $('#supir_mobil_id').val();
		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		window.open(window.location.origin+'/'+'views/admin/laporan/cetak-pendapatan-supir.php?id='+supir_mobil_id+'&bulan='+bulan+'&tahun='+tahun, '_blank', 'location=yes, height=570, width=1000, scrollbars=yes, status=yes');
	});

	$('#btn-cetak-laba-rugi').on('click', function(){
		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		window.open(window.location.origin+'/'+'views/admin/laporan/cetak-laba-rugi.php?bulan='+bulan+'&tahun='+tahun, '_blank', 'location=yes, height=570, width=1000, scrollbars=yes, status=yes');
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
			var uid = data.data.id;
			$('#mobilFormModalLabel').text('Form Ubah Data Mobil');
			$('#form-mobil').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(uid);
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
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data mobil ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/mobil/hapus-mobil.php',
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

function getDataKebun(id) {
	$.ajax({
		url: '/app/kebun/get-data-kebun.php',
		method: 'POST',
		dataType: 'JSON',
		data: { uid: id },
		success: function(data){
			$('#kebunFormModalLabel').text('Form Ubah Data Kebun Sawit');
			$('#form-kebun').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#nama').val(data.data.nama);
			$('#alamat').val(data.data.alamat);
			$('#telepon').val(data.data.telepon);
			$('#email').val(data.data.email);
			$('#toleransi').val(data.data.toleransi);
			$('#kebunFormModal').modal('show');
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

function deleteDataKebun(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data kebun sawit ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/kebun/hapus-kebun.php',
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

function getDataPelabuhan(id) {
	$.ajax({
		url: '/app/pelabuhan/get-data-pelabuhan.php',
		method: 'POST',
		dataType: 'JSON',
		data: { uid: id },
		success: function(data){
			$('#pelabuhanFormModalLabel').text('Form Ubah Data Pelabuhan');
			$('#form-pelabuhan').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#nama').val(data.data.nama);
			$('#alamat').val(data.data.alamat);
			$('#telepon').val(data.data.telepon);
			$('#email').val(data.data.email);
			$('#pelabuhanFormModal').modal('show');
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

function deleteDataPelabuhan(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data pelabuhan ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/pelabuhan/hapus-pelabuhan.php',
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

function ubahStatusDO(id, status) {
	if (status == '0') {
		swal({
			title: 'Peringatan!',
			text: "Apakah anda yakin untuk menutup Delivery Order ini? Status tidak akan bisa diubah lagi.",
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Tidak',
			confirmButtonText: 'Ya, Saya Yakin!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: '/app/do/ubah-status-do.php',
					method: 'POST',
					dataType: 'JSON',
					data: {
						uid: id,
						status: status
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
}

function deleteDataDO(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data pelabuhan ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/do/hapus-do.php',
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
								// location.reload();
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

function getDataSupirMobil(id) {
	$.ajax({
		url: '/app/supir_mobil/get-data-supir-mobil.php',
		method: 'POST',
		dataType: 'JSON',
		data: { uid: id },
		success: function(data){
			var supir_id = data.data.supir_id;
			var mobil_id = data.data.mobil_id;
			$('#supirMobilFormModalLabel').text('Form Ubah Data Supir Mobil');
			$('#form-supir-mobil').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#supir_id').val(supir_id).trigger('change');
			$('#mobil_id').val(mobil_id).trigger('change');
			$('#supirMobilFormModal').modal('show');
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

function deleteDataSupirMobil(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data supir mobil ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/supir_mobil/hapus-supir-mobil.php',
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

function getDataKendala(id) {
	$.ajax({
		url: '/app/kendala/get-data-kendala.php',
		method: 'POST',
		dataType: 'JSON',
		data: { uid: id },
		success: function(data){
			$('#kendalaFormModalLabel').text('Form Ubah Data Kendala');
			$('#form-kendala').trigger('reset');
			$('#aksi').val('ubah');
			$('#uid').val(data.data.id);
			$('#supir_mobil_id').val(data.data.supir_mobil_id).trigger('change');
			$('#tanggal').val(data.data.tanggal);
			$('#kendala').val(data.data.kendala).trigger('change');
			$('#biaya').val(data.data.biaya);
			$('#keterangan').val(data.data.keterangan);
			$('#kendalaFormModal').modal('show');
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

function deleteDataKendala(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin ingin menghapus data kendala ini?",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/kendala/hapus-kendala.php',
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

function doubleDO(id) {
	swal({
		title: 'Peringatan!',
		text: "Apakah anda yakin untuk Double Delivery Order ini? Status tidak akan bisa diubah lagi.",
		type: 'warning',
		showCancelButton: true,
		cancelButtonText: 'Tidak',
		confirmButtonText: 'Ya, Saya Yakin!'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: '/app/do/double.php',
				method: 'POST',
				dataType: 'JSON',
				data: {
					uid: id,
					status: status
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