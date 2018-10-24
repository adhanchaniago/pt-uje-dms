<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	<title>PT. Usaha Jaya Express</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/vendors/sweetalert/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
	<nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="?page=beranda">
				<img src="/assets/img/logo1.png" width="70" height="50" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto justify-content-end">
					<li class="nav-item active">
						<a class="nav-link" href="?page=beranda">
							<i class="fa fa-home"></i>
							BERANDA
							<span class="sr-only">(current)</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?page=tentang">
							<i class="fa fa-question"></i>
							TENTANG
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?page=layanan">
							<i class="fa fa-clipboard"></i>
							LAYANAN
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="?page=kontak">
							<i class="fa fa-address-book"></i>
							KONTAK
						</a>
					</li>
				</ul>
				<a class="btn btn-outline-success my-2 my-sm-0" href="login.php"><i class="fa fa-sign-in-alt"></i> LOGIN</a>
			</div>
		</div>
	</nav>

	<div class="content">
		
		<?php  

			if (isset($_GET['page'])) {
				$page = $_GET['page'];
				if ($page == 'beranda') {
					include 'views/home/beranda.php';
				} elseif ($page == 'tentang') {
					include 'views/home/tentang.php';
				}
			}

		?>

	</div>

	<script src="assets/vendors/jquery/jquery.min.js"></script>
	<script src="assets/vendors/popper/dist/umd/popper.min.js"></script>
	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>