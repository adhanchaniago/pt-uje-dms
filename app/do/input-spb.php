<?php 

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$jalan_detail_id = sanitizeThis($_POST['jalan_detail_id']);
	$jalan_id = sanitizeThis($_POST['jalan_id']);
	$muat_tanggal = sanitizeThis($_POST['muat_tanggal']);
	$muat_total_muatan = sanitizeThis($_POST['muat_total_muatan']);
	$muat_berat_keseluruhan = sanitizeThis($_POST['muat_berat_keseluruhan']);
	$bongkar_tanggal = sanitizeThis($_POST['bongkar_tanggal']);
	$bongkar_total_muatan = sanitizeThis($_POST['bongkar_total_muatan']);
	$bongkar_berat_keseluruhan = sanitizeThis($_POST['bongkar_berat_keseluruhan']);

	$query = "INSERT INTO tb_spb (jalan_detail_id, muat_tanggal, muat_total_muatan, muat_berat_keseluruhan, bongkar_tanggal, bongkar_total_muatan, bongkar_berat_keseluruhan) VALUES('$jalan_detail_id', '$muat_tanggal', '$muat_total_muatan', '$muat_berat_keseluruhan', '$bongkar_tanggal', '$bongkar_total_muatan', '$bongkar_berat_keseluruhan')";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data SPB Muat dan Bongkar berhasil ditambahkan!';
		$data['url'] = '/admin.php?page=detail-do&id='.$jalan_id; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>