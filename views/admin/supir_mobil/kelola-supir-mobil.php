<style>
	.selection{
		width: 100%;
	}
</style>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Data Supir Mobil</h5><hr>
				<?php if ($hak_akses == 'admin'): ?>
					<button type="button" class="btn btn-primary" id="btn-tambah-supir-mobil">Tambah Supir Mobil Baru</button><br><br>
				<?php endif ?>
				<table id="table-data-supir-mobil" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>No Plate</th>
							<th>Merk</th>
							<th>Gross</th>
							<th>Nama Supir</th>	
							<th>No NIK</th>
							<th>No SIM</th>
							<th>Status</th>
							<?php if ($hak_akses == 'admin'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php  
							$list_data = [];
							$query = "
								SELECT tb_supir_mobil.id, tb_supir_mobil.status, tb_supir.nama, 
								tb_supir.ktp_no, tb_supir.sim_no, tb_mobil.plate, tb_mobil.merk, tb_mobil.gross 
								FROM tb_supir_mobil, tb_supir, tb_mobil 
								WHERE tb_supir_mobil.supir_id = tb_supir.id AND tb_supir_mobil.mobil_id = tb_mobil.id 
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
								<td><?php echo $value['merk'] ?></td>
								<td><?php echo number_format($value['gross']) ?> KG</td>
								<td><?php echo $value['nama'] ?></td>
								<td><?php echo $value['ktp_no'] ?></td>
								<td><?php echo $value['sim_no'] ?></td>
								<td><?php echo $value['status'] == '1' ? 'Jalan' : 'Parkir' ?></td>
								<?php if ($hak_akses == 'admin'): ?>
									<td>
										<div class="btn-group">
											<button type="button" class="btn btn-success btn-sm btn-ubah-mobil" onclick="getDataSupirMobil(<?php echo $value['id'] ?>)"><i class="fa fa-edit"></i>&nbsp;UBAH</button> 
											<button type="button" class="btn btn-danger btn-sm btn-hapus-mobil" onclick="deleteDataSupirMobil(<?php echo $value['id'] ?>)"><i class="fa fa-eraser"></i>&nbsp;HAPUS</button>
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

<div class="modal fade" id="supirMobilFormModal" tabindex="-1" role="dialog" aria-labelledby="supirMobilFormModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="supirMobilFormModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" id="form-supir-mobil" enctype="multipart/form-data">
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
								<option value="<?php echo $value['id'] ?>">
									<?php  
										echo $value['ktp_no'].' : '.$value['nama'].' '.(checkSupir($value['id']) != '0' ? '*' : '')
									?>
								</option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<select class="form-control" id="mobil_id" name="mobil_id" style="width: 100%;" required>
							<option></option>
							<?php  

								$qMobil = "SELECT * FROM tb_mobil";
								$pMobil = mysqli_query($conn, $qMobil);
								while($rMobil = mysqli_fetch_array($pMobil)) {
									$dMobil[] = $rMobil;
								}
								foreach ($dMobil as $key => $value) {
									
							?>
								<option value="<?php echo $value['id'] ?>" onclick='return false;'>
									<?php 
										echo $value['plate'].' : '.$value['merk'].' ('.number_format($value['gross']).' KG) '.(checkMobil($value['id']) != '0' ? '*' : '')
									?>
								</option>
							<?php
								}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" id="btn-supir-mobil" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>