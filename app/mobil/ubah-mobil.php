<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);
	$supir_id = sanitizeThis($_POST['supir_id']);
	$plate = sanitizeThis($_POST['plate']);
	$merk = sanitizeThis($_POST['merk']);
	$jenis = sanitizeThis($_POST['jenis']);
	$gross = sanitizeThis($_POST['gross']);

	if ($_FILES['foto']['name'] != NULL) {
		$file_type = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
		$file_name = sanitizeThis($_FILES['foto']['name']);
		$file_size = $_FILES['foto']['size'];
		$target_dir = '../../assets/img/mobil/';
		$check = getimagesize($_FILES['foto']['tmp_name']);
		if ($check == false) {
			$data['status'] = 'ERROR';
			$data['message'] = 'Foto Mobil yang diinputkan bukan merupakan file gambar!';
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
			$data['message'] = 'Ukuran file Foto Mobil maksimal 2MB!';
			echo json_encode($data);
			die();
		}
		$new_file_name = substr(sha1(time()), 0, 20).'.'.$file_type;
		$new_target_file = $target_dir.$new_file_name;
		$upload_file = move_uploaded_file($_FILES['foto']['tmp_name'], $new_target_file);
		if (!$upload_file) {
			$data['status'] = 'ERROR';
			$data['message'] = 'Telah terjadi kesalahan dalam mengupload Foto Mobil!';
			echo json_encode($data);
			die();
		}
		$sql_upload = "UPDATE tb_mobil SET foto = '$new_file_name' WHERE id = '$uid'";
		$process_upload = mysqli_query($conn, $sql_upload);
		if (!$process_upload) {
			$data['status'] = 'ERROR';
			$data['message'] = 'Telah terjadi kesalahan dalam mengupload foto!';
			echo json_encode($data);
			die();
		}
	}

	$query = "UPDATE tb_mobil SET supir_id = '$supir_id', plate = '$plate', merk = '$merk', jenis = '$jenis', gross = '$gross' WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Mobil berhasil diubah!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>