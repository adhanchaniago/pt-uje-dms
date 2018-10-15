<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$nama = sanitizeThis($_POST['nama']);
	$alamat = sanitizeThis($_POST['alamat']);
	$telepon = sanitizeThis($_POST['telepon']);
	$email = sanitizeThis($_POST['email']);

	$query = "INSERT INTO tb_pelabuhan (nama, alamat, telepon, email) VALUES('$nama', '$alamat', '$telepon', '$email')";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Pelabuhan berhasil ditambahkan!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>