<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Admin Profile</h5><hr>
				<p>Silahkan lengkapi form berikut ini :</p>
				<?php  

					$uid = $_SESSION['uid'];
					$query = "SELECT * FROM tb_user WHERE id = $uid";
					$process = mysqli_query($conn, $query);
					$dtProfile = mysqli_fetch_assoc($process);

				?>
				<form method="POST" id="form-profile" enctype="multipart/form-data">
					<input type="hidden" id="uid" name="uid" value="<?php echo $uid ?>">
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $dtProfile['nama'] ?>">
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">Jenis Kelamin</label>
						<select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
							<option value="<?php echo $dtProfile['jenis_kelamin'] ?>"><?php echo ucfirst($dtProfile['jenis_kelamin']) ?></option>
							<option value="pria">Pria</option>
							<option value="wanita">Wanita</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tempat_lahir">Tempat Lahir</label>
						<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $dtProfile['tempat_lahir'] ?>">
					</div>
					<div class="form-group">
						<label for="tanggal_lahir">Tanggal Lahir</label>
						<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $dtProfile['tanggal_lahir'] ?>">
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" id="alamat" name="alamat"><?php echo $dtProfile['alamat'] ?></textarea>
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $dtProfile['telepon'] ?>">
					</div>
					<div class="form-group">
						<label for="foto">Foto</label>
						<input type="file" class="form-control" id="foto" name="foto">
					</div>
					<hr>
					<div class="form-group text-right">
						<button class="btn btn-success" type="submit" id="btn-profile">UPDATE</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>