<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT * FROM tb_mobil WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataMobil = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataMobil;

	echo json_encode($data);

?>