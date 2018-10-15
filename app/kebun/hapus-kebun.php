<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$uid = $_POST['uid'];

	$query = "DELETE FROM tb_kebun WHERE id = '$uid'";
	$process = mysqli_query($conn, $query);

	if ($process) {
		$data['status'] = 'OK';
		$data['message'] = 'Data Kebun Sawit berhasil dihapus!'; 
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Telah terjadi sebuah kesalahan!';
	}

	echo json_encode($data);

?>