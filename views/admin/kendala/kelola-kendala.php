<style>
	.selection{
		width: 100%;
	}
	.datepicker{
		z-index:9999 !important;
	}
</style>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Kendala</h5><hr>
				<?php if ($hak_akses == 'admin'): ?>
					<button type="button" class="btn btn-primary" id="btn-tambah-kendala">Tambah Kendala Baru</button><br><br>
				<?php endif ?>
				<table id="table-data-pelabuhan" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Plate</th>
							<th>Supir</th>
							<th>Tanggal</th>
							<th>Kendala</th>
							<th>Biaya</th>
							<th>Keterangan</th>
							<?php if ($hak_akses == 'admin'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php  

							$list_data = [];
							$query = "
								SELECT tb_kendala.id, tb_kendala.tanggal, tb_kendala.kendala, tb_kendala.biaya, 
								tb_kendala.keterangan, tb_mobil.plate, tb_supir.nama 
								FROM tb_kendala, tb_supir_mobil, tb_mobil, tb_supir 
								WHERE tb_kendala.supir_mobil_id = tb_supir_mobil.id AND tb_supir_mobil.supir_id = tb_supir.id 
								AND tb_supir_mobil.mobil_id = tb_mobil.id
							";
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
								<td><?php echo date('d M Y', strtotime($value['tanggal'])) ?></td>
								<td><?php echo ucfirst($value['kendala']) ?></td>
								<td>IDR <?php echo number_format($value['biaya']) ?></td>
								<td><?php echo $value['keterangan'] ?></td>
								<?php if ($hak_akses == 'admin'): ?>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-success btn-sm btn-ubah-pelabuhan" onclick="getDataKendala(<?php echo $value['id'] ?>)"><i class="fa fa-edit"></i>&nbsp;UBAH</button> 
											<button type="button" class="btn btn-danger btn-sm btn-hapus-pelabuhan" onclick="deleteDataKendala(<?php echo $value['id'] ?>)"><i class="fa fa-eraser"></i>&nbsp;HAPUS</button>
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

<div class="modal fade" id="kendalaFormModal" tabindex="-1" role="dialog" aria-labelledby="kendalaFormModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kendalaFormModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-kendala" enctype="multipart/form-data">
				<div class="modal-body">
					<p>Silahkan isi from berikut ini :</p>
					<input type="hidden" name="uid" id="uid" value="">
					<input type="hidden" name="aksi" id="aksi" value="" required>
					<div class="form-group">
						<label for="supir_mobil_id">Armada</label>
						<select class="form-control" name="supir_mobil_id" id="supir_mobil_id" style="width: 100%;">
							<option value=""></option>
							<?php  
								$listMobil = [];
								$qMobil = "
									SELECT tb_supir_mobil.id, tb_mobil.plate, tb_supir.nama 
									FROM tb_supir_mobil, tb_mobil, tb_supir WHERE tb_supir_mobil.supir_id = tb_supir.id 
									AND tb_supir_mobil.mobil_id = tb_mobil.id AND tb_supir_mobil.status = 0
								";
								$pMobil = mysqli_query($conn, $qMobil);
								while($rMobil = mysqli_fetch_array($pMobil)) {
									$listMobil[] = $rMobil;
								}
								foreach ($listMobil as $vMobil) {
									echo '<option value="'.$vMobil['id'].'">'.$vMobil['plate'].' : '.$vMobil['nama'].'</option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="tanggal">Tanggal</label>
						<input type="text" class="form-control" id="tanggal" name="tanggal" value="" required>
					</div>
					<div class="form-group">
						<label for="kendala">Kendala</label>
						<select class="form-control" id="kendala" name="kendala" style="width: 100%;">
							<option value=""></option>
							<option value="ban">Ban</option>
							<option value="baut roda">Baut Roda</option>
							<option value="benen">Benen</option>
							<option value="oli">Oli</option>
							<option value="selendang">Selendang Ban</option>
						</select>
					</div>
					<div class="form-group">
						<label for="biaya">Biaya</label>
						<input type="text" class="form-control" id="biaya" name="biaya" value="" required>
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan</label>
						<input type="text" class="form-control" id="keterangan" name="keterangan" value="">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-kendala" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>