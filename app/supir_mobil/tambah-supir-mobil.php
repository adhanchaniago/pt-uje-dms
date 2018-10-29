<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$supir_id = sanitizeThis($_POST['supir_id']);
	$mobil_id = sanitizeThis($_POST['mobil_id']);

	$checkSupir = checkSupir($supir_id);
	if ($checkSupir != '0') {
		$data['status'] = 'ERROR';
		$data['message'] = 'Supir yang diinputkan sudah terdaftar!';
		echo json_encode($data);
		die();
	}

	$checkMobil = checkMobil($mobil_id);
	if ($checkMobil != '0') {
		$data['status'] = 'ERROR';
		$data['message'] = 'Mobil yang diinputkan sudah terdaftar!';
		echo json_encode($data);
		die();
	}

	$query = "INSERT INTO tb_supir_mobil (supir_id, mobil_id, status) VALUES('$supir_id', '$mobil_id', '0')";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Supir Mobil berhasil ditambahkan!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>