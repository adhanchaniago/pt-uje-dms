<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT * FROM tb_pelabuhan WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataPelabuhan = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataPelabuhan;

	echo json_encode($data);

?>