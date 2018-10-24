<?php  
	session_start();

	if (isset($_SESSION['uid'])) {
		if ($_SESSION['akses'] == 'admin') {
			header('Location: admin.php?page=home');
			die();
		} elseif ($_SESSION['akses'] == 'pimpinan') {
			header('Location: pimpinan.php?page=home');
			die();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<title>Selamat Datang</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/vendors/sweetalert/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<a href="home.php">
							<h5 class="card-title text-center"><img src="assets/img/logo2.png" width="200px"></h5>
						</a>
						<p class="text-center">
							Silahkan Masukkan Username dan Password :
						</p>
						<hr class="my-4">
						<form id="form-signin" class="form-signin">
							<div class="form-label-group">
								<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
								<label for="username">Username</label>
							</div>

							<div class="form-label-group">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
								<label for="password">Password</label>
							</div>

							<hr class="my-4">

							<button class="btn btn-lg btn-success btn-block text-uppercase" id="btn-masuk" type="submit">MASUK</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/vendors/jquery/jquery.min.js"></script>
	<script src="assets/vendors/popper/dist/umd/popper.min.js"></script>
	<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendors/sweetalert/dist/sweetalert2.min.js"></script>
	<script src="assets/js/app.js"></script>

	<script type="text/javascript">

		$(function(){

			$('#form-signin').on('submit', function(e){
				e.preventDefault();
				$.ajax({
					url: '/app/auth/login.php',
					method: 'POST',
					dataType: 'JSON',
					beforeSend: function(){
						$('#btn-masuk').prop('disabled', 'disabled');
					},
					data: {
						username: $('#username').val(),
						password: $('#password').val()
					},
					success: function(data){
						if (data.status == 'OK'){
							swal({
								title: 'Success!',
								text: data.message,
								type: 'success',
								showConfirmButton: false,
								timer: 1500
							}).then((result) => {
								if (result.dismiss){
									window.location = data.url;
								}
							});
						} else{
							swal({
								title: 'Error!',
								text: data.message,
								type: 'error',
								confirmButtonText: 'OKE'
							});
						}
						$('#form-signin').trigger('reset');
						$('#btn-masuk').removeAttr('disabled');
					},
					error: function(error){
						swal({
							title: 'Error!',
							text: 'Mohon maaf telah terjadi sebuah kesalahan, silahkan reload kembali halaman ini.',
							type: 'error',
							confirmButtonText: 'OKE'
						});
						$('#form-signin').trigger('reset');
						$('#btn-masuk').removeAttr('disabled');
					}
				});
			});

		});

	</script>
</body>
</html>