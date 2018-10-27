<?php  
	
	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = $_POST['uid'];

	mysqli_autocommit($conn, FALSE);

	$listDetail = [];
	$qListDetail = "SELECT id FROM tb_jalan_detail WHERE jalan_id = '$uid'";
	$pListDetail = mysqli_query($conn, $qListDetail);
	while($row = mysqli_fetch_array($pListDetail)) {
		$listDetail[] = $row;
	}

	foreach ($listDetail as $value) {
		$qDelSpb = "DELETE FROM tb_spb WHERE jalan_detail_id = '".$value['id']."'";
		$pDelSpb = mysqli_query($conn, $qDelSpb);
		if (!$pDelSpb) {
			mysqli_rollback($conn);
		}

		$qDelDetail = "DELETE FROM tb_jalan_detail WHERE id = '".$value['id']."'";
		$pDelDetail = mysqli_query($conn, $qDelDetail) or die(mysqli_error($conn));
		if (!$pDelDetail) {
			mysqli_rollback($conn);
		}
	}

	$qDelJalan = "DELETE FROM tb_jalan WHERE id = '$uid'";
	$pDelJalan = mysqli_query($conn, $qDelJalan);
	if (!$pDelJalan) {
		mysqli_rollback($conn);
	}

	mysqli_commit($conn);

	$data['status'] = 'OK';
	$data['message'] = 'Delivery Order berhasil dihapus!'; 

	echo json_encode($data);
	

?>