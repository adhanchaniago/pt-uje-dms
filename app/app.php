<?php  

	function koneksi() {
		$host = 'localhost';
		$user = 'root';
		$pass = '';
		$db = 'pt-uje-db';
		$conn = mysqli_connect($host, $user, $pass, $db);
		return $conn;
	}

	function sanitizeThis($string) {
		$conn = koneksi();
		$output1 = mysqli_real_escape_string($conn, $string);
		$output2 = strip_tags($output1);
		return htmlspecialchars($output2); 
	}

	function getProfile() {
		$conn = koneksi();
		$uid = $_SESSION['uid'];
		$query = "SELECT * FROM tb_user WHERE id = '$uid'";
		$process = mysqli_query($conn, $query);
		$data = mysqli_fetch_assoc($process);
		return $data;
	}

	function checkSPB($id) {
		$conn = koneksi();
		$query = "SELECT * FROM tb_spb WHERE jalan_detail_id = '$id'";
		$process = mysqli_query($conn, $query);
		$count = mysqli_num_rows($process);
		return $count;
	}

	function checkNikSim($nik, $sim) {
		$conn = koneksi();
		$query = "SELECT * FROM tb_supir WHERE ktp_no = '$nik' OR sim_no = '$sim'";
		$process = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$row = mysqli_num_rows($process);
		return $row;
	}

	function checkSupir($supir_id) {
		$conn = koneksi();
		$query = "SELECT * FROM tb_supir_mobil WHERE supir_id = '$supir_id'";
		$process = mysqli_query($conn, $query);
		$row = mysqli_num_rows($process);
		return $row;
	}

	function checkMobil($mobil_id) {
		$conn = koneksi();
		$query = "SELECT * FROM tb_supir_mobil WHERE mobil_id = '$mobil_id'";
		$process = mysqli_query($conn, $query);
		$row = mysqli_num_rows($process);
		return $row;
	}

	function checkPassword($pass, $konfr) {
		$stat = false;
		if ($pass == $konfr) {
			$stat = true;
		}
		return $stat;
	}

	function checkPlate($plate) {
		$conn = koneksi();
		$query = "SELECT * FROM tb_mobil WHERE plate = '$plate'";
		$process = mysqli_query($conn, $query);
		$row = mysqli_num_rows($process);
		return $row;
	}

?>