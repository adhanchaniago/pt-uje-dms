<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);
	$password = sanitizeThis($_POST['password']);
	$konfirmasi_password = sanitizeThis($_POST['konfirmasi_password']);

	$check = checkPassword($password, $konfirmasi_password);
	if (!$check) {
		$data['status'] = 'ERROR';
		$data['message'] = 'Password yang diinputkan tidak cocok!';
		echo json_encode($data);
		die();
	}

	$new_password = md5($password);

	$query = "UPDATE tb_user SET password = '$new_password' WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data profil berhasil diperbaharui!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);


?>