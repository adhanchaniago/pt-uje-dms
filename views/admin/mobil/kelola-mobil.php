<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Mobil</h5><hr>
				<?php if ($hak_akses == 'admin'): ?>
					<button type="button" class="btn btn-primary" id="btn-tambah-mobil">Tambah Mobil Baru</button><br><br>
				<?php endif ?>
				<table id="table-data-mobil" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Plate No</th>
							<th>Merk</th>
							<th>Jenis</th>
							<th>Gross</th>
							<th>Foto</th>
							<?php if ($hak_akses == 'admin'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php  
							$list_data = [];
							$query = "SELECT * FROM tb_mobil";
							$process = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($process)) {
								$list_data[] = $row;
							}

							foreach ($list_data as $key => $value) {
						?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['plate'] ?></td>
								<td><?php echo $value['merk'] ?></td>
								<td><?php echo $value['jenis'] ?></td>
								<td><?php echo number_format($value['gross']) ?> KG</td>
								<td><img src="/assets/img/mobil/<?php echo $value['foto'] ?>" width="150px"></td>
								<?php if ($hak_akses == 'admin'): ?>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-success btn-sm btn-ubah-mobil" onclick="getDataMobil(<?php echo $value['id'] ?>)"><i class="fa fa-edit"></i>&nbsp;UBAH</button> 
											<button type="button" class="btn btn-danger btn-sm btn-hapus-mobil" onclick="deleteDataMobil(<?php echo $value['id'] ?>)"><i class="fa fa-eraser"></i>&nbsp;HAPUS</button>
										</div>
									</td>
								<?php endif ?>
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

<div class="modal fade" id="mobilFormModal" tabindex="-1" role="dialog" aria-labelledby="mobilFormModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mobilFormModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-mobil" enctype="multipart/form-data">
				<div class="modal-body">
					<p>Silahkan isi from berikut ini :</p>
					<input type="hidden" name="uid" id="uid" value="">
					<input type="hidden" name="aksi" id="aksi" value="" required>
					<div class="form-group">
						<label for="plate">Nomor Plate</label>
						<input type="text" class="form-control" id="plate" name="plate" value="" required>
					</div>
					<div class="form-group">
						<label for="merk">Merk</label>
						<input type="text" class="form-control" id="merk" name="merk" value="" required>
					</div>
					<div class="form-group">
						<label for="jenis">Jenis</label>
						<input type="text" class="form-control" id="jenis" name="jenis" value="" required>
					</div>
					<div class="form-group">
						<label for="gross">Gross (KG)</label>
						<input type="text" class="form-control" id="gross" name="gross" value="" required>
					</div>
					<div class="form-group">
						<label for="foto">Foto Mobil</label>
						<input type="file" class="form-control" id="foto" name="foto" value="" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-mobil" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>