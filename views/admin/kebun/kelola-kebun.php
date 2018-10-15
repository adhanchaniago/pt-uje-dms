<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Kelola Data Kebun Sawit</h5><hr>
				<button type="button" class="btn btn-primary" id="btn-tambah-kebun">Tambah Kebun Sawit Baru</button><br><br>
				<table id="table-data-kebun" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>Email</th>
							<th>Toleransi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  

							$list_data = [];
							$query = "SELECT * FROM tb_kebun";
							$process = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($process)) {
								$list_data[] = $row;
							}

							foreach ($list_data as $key => $value) {
						?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['alamat'] ?></td>
								<td><?php echo $value['telepon'] ?></td>
								<td><?php echo $value['email'] ?></td>
								<td><?php echo $value['toleransi'] ?> %</td>
								<td>
									<button type="button" class="btn btn-success btn-sm btn-ubah-kebun" onclick="getDataKebun(<?php echo $value['id'] ?>)"><i class="fa fa-pencil-alt"></i> UBAH</button> 
									<button type="button" class="btn btn-danger btn-sm btn-hapus-kebun" onclick="deleteDataKebun(<?php echo $value['id'] ?>)"><i class="fa fa-trash-alt"></i> HAPUS</button>
								</td>
							</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>

<div class="modal fade" id="kebunFormModal" tabindex="-1" role="dialog" aria-labelledby="kebunFormModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kebunFormModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-kebun" enctype="multipart/form-data">
				<div class="modal-body">
					<p>Silahkan isi from berikut ini :</p>
					<input type="hidden" name="uid" id="uid" value="">
					<input type="hidden" name="aksi" id="aksi" value="" required>
					<div class="form-group">
						<label for="nama">Nama Kebun</label>
						<input type="text" class="form-control" id="nama" name="nama" value="" required>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat Kebun</label>
						<input type="text" class="form-control" id="alamat" name="alamat" value="" required>
					</div>
					<div class="form-group">
						<label for="telepon">Telepon</label>
						<input type="text" class="form-control" id="telepon" name="telepon" value="" required>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" id="email" name="email" value="" required>
					</div>
					<div class="form-group">
						<label for="toleransi">Toleransi (%)</label>
						<input type="text" class="form-control" id="toleransi" name="toleransi" value="" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-kebun" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>