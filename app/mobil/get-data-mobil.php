<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	$query = "SELECT tb_mobil.id AS mobilID, tb_mobil.supir_id, tb_mobil.plate, tb_mobil.merk, tb_mobil.jenis, tb_mobil.gross, tb_mobil.foto, tb_supir.nama, tb_supir.ktp_no, tb_supir.sim_no FROM tb_mobil, tb_supir WHERE tb_mobil.supir_id = tb_supir.id AND tb_mobil.id = '$uid'";
	$process = mysqli_query($conn, $query);
	$dataMobil = mysqli_fetch_assoc($process);

	$data['status'] = 'OK';
	$data['data'] = $dataMobil;

	echo json_encode($data);

?>