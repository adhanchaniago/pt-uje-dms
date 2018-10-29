<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = sanitizeThis($_POST['uid']);
	$supir_id = sanitizeThis($_POST['supir_id']);
	$mobil_id = sanitizeThis($_POST['mobil_id']);

	$query = "UPDATE tb_supir_mobil SET supir_id = '$supir_id', mobil_id = '$mobil_id' WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Supir Mobil berhasil diubah!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>