<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT * FROM tb_supir WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataSupir = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataSupir;

	echo json_encode($data);


?>