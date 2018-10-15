<style type="text/css">
	#form-mobil > div.modal-body > div:nth-child(4) > span > span.selection {
		width: 100%;
	}
</style>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Kelola Data Supir</h5><hr>
				<button type="button" class="btn btn-primary" id="btn-tambah-mobil">Tambah Mobil Baru</button><br><br>
				<table id="table-data-mobil" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Plate No</th>
							<th>Nama Supir</th>
							<th>Merk</th>
							<th>Jenis</th>
							<th>Gross</th>
							<th>Status</th>
							<th>Foto</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  

							$list_data = [];
							$query = "SELECT tb_mobil.id, tb_mobil.plate, tb_mobil.merk, tb_mobil.jenis, tb_mobil.gross, tb_mobil.status, tb_mobil.foto, tb_supir.nama FROM tb_mobil, tb_supir WHERE tb_mobil.supir_id = tb_supir.id";
							$process = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($process)) {
								$list_data[] = $row;
							}

							foreach ($list_data as $key => $value) {
						?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['plate'] ?></td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['merk'] ?></td>
								<td><?php echo $value['jenis'] ?></td>
								<td><?php echo number_format($value['gross']) ?> KG</td>
								<td><?php echo $value['status'] ?></td>
								<td><img src="/assets/img/mobil/<?php echo $value['foto'] ?>" width="150px"></td>
								<td>
									<button type="button" class="btn btn-success btn-sm btn-ubah-mobil" onclick="getDataMobil(<?php echo $value['id'] ?>)"><i class="fa fa-pencil-alt"></i> UBAH</button> 
									<button type="button" class="btn btn-danger btn-sm btn-hapus-mobil" onclick="deleteDataMobil(<?php echo $value['id'] ?>)"><i class="fa fa-trash-alt"></i> HAPUS</button>
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
						<select class="form-control" id="supir_id" name="supir_id" style="width: 100%;" required>
							<option></option>
							<?php  

								$qSupir = "SELECT * FROM tb_supir";
								$pSupir = mysqli_query($conn, $qSupir);
								while($rSupir = mysqli_fetch_array($pSupir)) {
									$dSupir[] = $rSupir;
								}
								foreach ($dSupir as $key => $value) {
									
							?>
								<option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
							<?php
								}
							?>
						</select>
					</div>
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
						<label for="gross">Gross</label>
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