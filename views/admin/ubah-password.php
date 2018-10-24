<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Ubah Password</h5><hr>
				<p>Silahkan lengkapi form berikut ini :</p>
				<?php $uid = $_SESSION['uid']; ?>
				<form method="POST" id="form-ubah-password">
					<input type="hidden" name="uid" id="uid" value="<?php echo $uid; ?>">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="password">Password Baru</label>
								<input type="password" name="password" id="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="konfirmasi_password">Konfimasi Password</label>
								<input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control">
							</div><br>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" id="btn-password">SIMPAN</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>