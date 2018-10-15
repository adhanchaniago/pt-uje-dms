<?php  

	require_once '../app.php';

	session_start();

	$conn = koneksi();
	$data = [];

	$username = sanitizeThis($_POST['username']);
	$password = md5(sanitizeThis($_POST['password']));

	$query = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
	$process = mysqli_query($conn, $query);
	$list_data = mysqli_fetch_assoc($process);
	$count = mysqli_num_rows($process);

	$status = $list_data['status'];
	$akses = $list_data['hak_akses'];

	if ($count == 1) {	
		if ($status != 1) {
			$data['status'] = 'ERROR';
			$data['message'] = 'Akun yang anda masukkan untuk sementara diblokir silahkan hubungi web administrator untuk info lebih lanjut!';
		} else {
			$_SESSION['uid'] = $list_data['id'];
			$_SESSION['uname'] = $list_data['username'];
			$_SESSION['akses'] = $akses;

			$data['status'] = 'OK';
			$data['message'] = 'Anda berhasil login, selamat datang!';
			if ($akses == 'admin') {
				$data['url'] = '/admin.php?page=home';
			} elseif ($akses == 'pimpinan') {
				$data['url'] = '/pimpinan.php?page=home';
			}
		}
	} else {
		$data['status'] = 'ERROR';
		$data['message'] = 'Username dan password yang anda inputkan tidak terdaftar atau salah!';
	}

	echo json_encode($data);

?>