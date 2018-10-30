<?php 

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);
	$supir_mobil_id = sanitizeThis($_POST['supir_mobil_id']);
	$tanggal = sanitizeThis($_POST['tanggal']);
	$kendala = sanitizeThis($_POST['kendala']);
	$biaya = sanitizeThis($_POST['biaya']);
	$keterangan = sanitizeThis($_POST['keterangan']);

	$query = "UPDATE tb_kendala SET supir_mobil_id = '$supir_mobil_id', tanggal = '$tanggal', kendala = '$kendala', biaya = '$biaya', keterangan = '$keterangan' WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Kendala berhasil diubah!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>