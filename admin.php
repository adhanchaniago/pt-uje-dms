<?php  

	session_start();

	require_once 'app/app.php';

	$conn = koneksi();

	if (!isset($_SESSION['uid'])) {
		session_unset();
		header('Location:login.php');
		die();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<title>PT. USAHA JAYA EXPRESS</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/vendors/sweetalert/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="assets/vendors/airdatepicker/dist/css/datepicker.min.css">
	<link rel="stylesheet" href="assets/vendors/datatables/datatables.min.css">
	<link rel="stylesheet" href="assets/vendors/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="assets/vendors/select2-bootstrap4/dist/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="assets/css/app.css">
</head>
<body>

	<div class="wrapper">
        
		<?php include 'views/partials/sidebar.php'; ?>

        <div id="content">
           
			<?php include 'views/partials/navbar.php'; ?>
            
			<?php  

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
					if ($page == 'home') {
						include 'views/admin/home.php';
					} elseif ($page == 'profile') {
						include 'views/admin/profile.php';
					} elseif ($page == 'supir') {
						include 'views/admin/supir/kelola-supir.php';
					} elseif ($page == 'mobil') {
						include 'views/admin/mobil/kelola-mobil.php';
					} elseif ($page == 'kebun') {
						include 'views/admin/kebun/kelola-kebun.php';
					} elseif ($page == 'pelabuhan') {
						include 'views/admin/pelabuhan/kelola-pelabuhan.php';
					} elseif ($page == 'tambah-do') {
						include 'views/admin/do/tambah-do.php';
					} elseif ($page == 'daftar-do') {
						include 'views/admin/do/daftar-do.php';
					} elseif ($page == 'detail-do') {
						include 'views/admin/do/detail-do.php';
					} elseif ($page == 'cetak-detail-do') {
						include 'views/admin/do/cetak-detail-do.php';
					} elseif ($page == 'cetak-pengantar') {
						include 'views/admin/do/cetak-pengantar.php';
					} elseif ($page == 'isi-spb') {
						include 'views/admin/do/isi-spb.php';
					}
				}

			?>

        </div>
    </div>
	
	<script src="assets/vendors/jquery/jquery.min.js"></script>
	<script src="assets/vendors/popper/dist/umd/popper.min.js"></script>
	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendors/sweetalert/dist/sweetalert2.min.js"></script>
	<script src="assets/vendors/airdatepicker/dist/js/datepicker.min.js"></script>
	<script src="assets/vendors/airdatepicker/dist/js/i18n/datepicker.en.js"></script>
	<script src="assets/vendors/datatables/datatables.min.js"></script>
	<script src="assets/vendors/select2/dist/js/select2.min.js"></script>
	<script src="assets/js/app.js"></script>

</body>
</html>