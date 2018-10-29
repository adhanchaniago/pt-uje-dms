<?php  
	
	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "
		SELECT tb_supir_mobil.id, tb_mobil.plate, tb_mobil.gross, tb_supir.nama 
		FROM tb_supir_mobil, tb_mobil, tb_supir WHERE tb_supir_mobil.supir_id = tb_supir.id 
		AND tb_supir_mobil.mobil_id = tb_mobil.id AND tb_supir_mobil.id = '$uid'
	";

	$process = mysqli_query($conn, $query);
	$dataSupirMobil = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataSupirMobil;

	echo json_encode($data);
	
?>