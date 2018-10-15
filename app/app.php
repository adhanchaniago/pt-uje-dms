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

?>