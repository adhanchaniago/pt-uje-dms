<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$supir_mobil_id = sanitizeThis($_POST['supir_mobil_id']);
	$tanggal = sanitizeThis($_POST['tanggal']);
	$bon_no = sanitizeThis($_POST['bon_no']);
	$kendala = sanitizeThis($_POST['kendala']);
	$biaya = sanitizeThis($_POST['biaya']);
	$keterangan = sanitizeThis($_POST['keterangan']);

	$query = "INSERT INTO tb_kendala (supir_mobil_id, bon_no, tanggal, kendala, biaya, keterangan) VALUES('$supir_mobil_id', '$bon_no', '$tanggal', '$kendala', '$biaya', '$keterangan')";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Kendala berhasil ditambahkan!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>