<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT * FROM tb_kebun WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataKebun = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataKebun;

	echo json_encode($data);

?>