<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_SESSION['uid']);
	$do_no = sanitizeThis($_POST['do_no']);
	$do_tanggal = sanitizeThis($_POST['do_tanggal']);
	$partai = sanitizeThis($_POST['partai']);
	$nominal = sanitizeThis($_POST['nominal']);
	$kebun_id = sanitizeThis($_POST['kebun_id']);
	$pelabuhan_id = sanitizeThis($_POST['pelabuhan_id']);
	$jenis = sanitizeThis($_POST['jenis']);
	$list_armada = $_POST['mobil_id'];
	$list_tanggal = $_POST['tanggal_berangkat'];
	$jml_armada = count($list_armada);

	mysqli_autocommit($conn, FALSE);

	$qJalan = "INSERT INTO tb_jalan (user_id, kebun_id, pelabuhan_id, do_no, do_tanggal, partai, jenis, nominal, status) VALUES('$uid', '$kebun_id', '$pelabuhan_id', '$do_no', '$do_tanggal', '$partai', '$jenis', '$nominal', '0')";
	$pJalan = mysqli_query($conn, $qJalan);

	$jalan_id = mysqli_insert_id($conn);

	for ($i = 0; $i < $jml_armada; $i++) {
		$qDetail = "INSERT INTO tb_jalan_detail (jalan_id, mobil_id, tanggal_berangkat) VALUES('$jalan_id', '$list_armada[$i]', '$list_tanggal[$i]')";
		$pDetail = mysqli_query($conn, $qDetail);

		$qMobil = "UPDATE tb_mobil SET status = '1' WHERE id = '$list_armada[$i]'";
		$pMobil = mysqli_query($conn, $qMobil);
	}

	mysqli_commit($conn);

	$data['status'] = 'OK';
	$data['message'] = 'Delivery Order berhasil ditambahkan!'; 
	$data['url'] = '?page=detail-do&id='.$jalan_id;

	echo json_encode($data);

?>