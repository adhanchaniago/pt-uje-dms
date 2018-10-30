<?php  
	
	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT * FROM tb_kendala WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataKendala = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataKendala;

	echo json_encode($data);

?>