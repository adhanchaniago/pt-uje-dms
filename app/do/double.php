<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);

	mysqli_autocommit($conn, FALSE);

	$qJalan = "UPDATE tb_jalan SET status = '1', dobel = '1' WHERE id = '".$uid."'";
	$pJalan = mysqli_query($conn, $qJalan);

	$listDetail = [];
	$qDetail = "SELECT * FROM tb_jalan_detail WHERE jalan_id = '$uid'";
	$pDetail = mysqli_query($conn, $qDetail);
	while($row = mysqli_fetch_array($pDetail)) {
		$listDetail[] = $row;
	}
	
	foreach ($listDetail as $vDetail) {
		$qMobil = "UPDATE tb_supir_mobil SET status = '0' WHERE id = '".$vDetail['supir_mobil_id']."'";
		$pMobil = mysqli_query($conn, $qMobil);
	}

	mysqli_commit($conn);

	$data['status'] = 'OK';
	$data['message'] = 'Status DO berhasil diubah!';

	echo json_encode($data);

?>