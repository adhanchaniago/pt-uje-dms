<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$ktp_no = sanitizeThis($_POST['ktp_no']);
	$sim_no = sanitizeThis($_POST['sim_no']);
	$nama = sanitizeThis($_POST['nama']);
	$jenis_kelamin = sanitizeThis($_POST['jenis_kelamin']);
	$tempat_lahir = sanitizeThis($_POST['tempat_lahir']);
	$tanggal_lahir = sanitizeThis($_POST['tanggal_lahir']);
	$alamat = sanitizeThis($_POST['alamat']);
	$telepon = sanitizeThis($_POST['telepon']);

	// check NIK
	
	$checkNikSim = checkNikSim($ktp_no, $sim_no);
	
	if ($checkNikSim != '0') {
		$data['status'] = 'ERROR';
		$data['message'] = 'NIK atau SIM yang diinputkan sudah terdaftar!';
		echo json_encode($data);
		die();
	}

	// Upload Foto KTP

	$file_type = strtolower(pathinfo($_FILES['ktp_img']['name'], PATHINFO_EXTENSION));
	$file_name = sanitizeThis($_FILES['ktp_img']['name']);
	$file_size = $_FILES['ktp_img']['size'];
	$target_dir = '../../assets/img/ktp/';
	$check = getimagesize($_FILES['ktp_img']['tmp_name']);
	if ($check == false) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Foto KTP yang diinputkan bukan merupakan file gambar!';
		echo json_encode($data);
		die();
	}
	if ($file_type != 'jpeg' && $file_type != 'jpg' && $file_type != 'png' && $file_type != 'JPEG' && $file_type != 'JPG' && $file_type != 'PNG') {
		$data['status'] = 'ERROR';
		$data['message'] = 'Hanya file gambar dengan ekstensi jpeg, jpg, dan png yang diizinkan!';
		echo json_encode($data);
		die();
	}
	if ($file_size > 2000000) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Ukuran file Foto KTP maksimal 2MB!';
		echo json_encode($data);
		die();
	}
	$new_file_name = substr(sha1(time()), 0, 20).'.'.$file_type;
	$new_target_file = $target_dir.$new_file_name;
	$upload_file = move_uploaded_file($_FILES['ktp_img']['tmp_name'], $new_target_file);
	if (!$upload_file) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi kesalahan dalam mengupload Foto KTP!';
		echo json_encode($data);
		die();
	}

	// Upload Foto SIM

	$file_type2 = strtolower(pathinfo($_FILES['sim_img']['name'], PATHINFO_EXTENSION));
	$file_name2 = sanitizeThis($_FILES['sim_img']['name']);
	$file_size2 = $_FILES['sim_img']['size'];
	$target_dir2 = '../../assets/img/sim/';
	$check2 = getimagesize($_FILES['sim_img']['tmp_name']);
	if ($check2 == false) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Foto SIM yang diinputkan bukan merupakan file gambar!';
		echo json_encode($data);
		die();
	}
	if ($file_type2 != 'jpeg' && $file_type2 != 'jpg' && $file_type2 != 'png' && $file_type2 != 'JPEG' && $file_type2 != 'JPG' && $file_type2 != 'PNG') {
		$data['status'] = 'ERROR';
		$data['message'] = 'Hanya file gambar dengan ekstensi jpeg, jpg, dan png yang diizinkan!';
		echo json_encode($data);
		die();
	}
	if ($file_size2 > 2000000) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Ukuran file Foto SIM maksimal 2MB!';
		echo json_encode($data);
		die();
	}
	$new_file_name2 = substr(sha1(time()), 0, 20).'.'.$file_type2;
	$new_target_file2 = $target_dir2.$new_file_name2;
	$upload_file2 = move_uploaded_file($_FILES['sim_img']['tmp_name'], $new_target_file2);
	if (!$upload_file2) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi kesalahan dalam mengupload Foto SIM!';
		echo json_encode($data);
		die();
	}

	$query = "INSERT INTO tb_supir (nama, jenis_kelamin, tempat_lahir, tanggal_lahir, alamat, telepon, ktp_no, ktp_img, sim_no, sim_img) VALUES('$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$telepon', '$ktp_no', '$new_file_name', '$sim_no', '$new_file_name2')";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Supir berhasil ditambahkan!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>