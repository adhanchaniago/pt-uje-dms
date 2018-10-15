<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);
	$nama = sanitizeThis($_POST['nama']);
	$alamat = sanitizeThis($_POST['alamat']);
	$telepon = sanitizeThis($_POST['telepon']);
	$email = sanitizeThis($_POST['email']);

	$query = "UPDATE tb_pelabuhan SET nama = '$nama', alamat = '$alamat', telepon = '$telepon', email = '$email' WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Pelabuhan berhasil diubah!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>