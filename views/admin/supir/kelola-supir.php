<style>
	.datepicker{z-index:1151 !important;}
</style>

<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Supir</h5><hr>
				<?php if ($hak_akses == 'admin'): ?>
					<button type="button" class="btn btn-primary" id="btn-tambah-supir">Tambah Supir Baru</button><br><br>
				<?php endif ?>
				<table id="table-data-supir" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>No KTP</th>
							<th>No SIM</th>
							<th>Nama Lengkap</th>
							<th>Jekel</th>
							<th>TTL</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>KTP IMG</th>
							<th>SIM IMG</th>
							<?php if ($hak_akses == 'admin'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php  

							$list_data = [];
							$query = "SELECT * FROM tb_supir";
							$process = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($process)) {
								$list_data[] = $row;
							}

							foreach ($list_data as $key => $value) {
								
						?>

						<tr>
							<td><?php echo $key+1 ?></td>
							<td><?php echo $value['ktp_no'] ?></td>
							<td><?php echo $value['sim_no'] ?></td>
							<td><?php echo $value['nama'] ?></td>
							<td><?php echo ucfirst($value['jenis_kelamin']) ?></td>
							<td><?php echo $value['tempat_lahir'].', '.date('d M Y', strtotime($value['tanggal_lahir'])) ?></td>
							<td><?php echo $value['alamat'] ?></td>
							<td><?php echo $value['telepon'] ?></td>
							<td><img src="/assets/img/ktp/<?php echo $value['ktp_img'] ?>" width="150px"></td>
							<td><img src="/assets/img/sim/<?php echo $value['ktp_img'] ?>" width="150px"></td>
							<?php if ($hak_akses == 'admin'): ?>
								<td>
									<div class="btn-group">
										<button type="button" class="btn btn-success btn-sm btn-ubah-supir" onclick="getDataSupir(<?php echo $value['id'] ?>)"><i class="fa fa-edit"></i>&nbsp;UBAH</button> 
										<button type="button" class="btn btn-danger btn-sm btn-hapus-supir" onclick="deleteDataSupir(<?php echo $value['id'] ?>)"><i class="fa fa-eraser"></i>&nbsp;HAPUS</button>
									</div>
								</td>
							<?php endif ?>
						</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>

<div class="modal fade" id="sopirFormModal" tabindex="-1" role="dialog" aria-labelledby="sopirFormModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="sopirFormModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-supir" enctype="multipart/form-data">
				<div class="modal-body">
					<p>Silahkan isi from berikut ini :</p>
					<input type="hidden" name="uid" id="uid" value="">
					<input type="hidden" name="aksi" id="aksi" value="" required>
					<div class="form-group">
						<label for="ktp_no">Nomor KTP</label>
						<input type="text" class="form-control" id="ktp_no" name="ktp_no" value="" required>
					</div>
					<div class="form-group">
						<label for="sim_no">Nomor SIM</label>
						<input type="text" class="form-control" id="sim_no" name="sim_no" value="" required>
					</div>
					<div class="form-group">
						<label for="nama">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama" name="nama" value="" required>
					</div>
					<div class="form-group">
						<label for="jenis_kelamin">Jenis Kelamin</label>
						<select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
							<option value=""></option>
							<option value="pria">Pria</option>
							<option value="wanita">Wanita</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tempat_lahir">Tempat Lahir</label>
						<input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="" required>
					</div>
					<div class="form-group">
						<label for="tanggal_lahir">Tanggal Lahir</label>
						<input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control" id="alamat" name="alamat" required></textarea>
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="text" class="form-control" id="telepon" name="telepon" value="" required>
					</div>
					<div class="form-group">
						<label for="ktp_img">Foto KTP</label>
						<input type="file" class="form-control" id="ktp_img" name="ktp_img" value="" required>
					</div>
					<div class="form-group">
						<label for="sim_img">Foto SIM</label>
						<input type="file" class="form-control" id="sim_img" name="sim_img" value="" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-supir" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>