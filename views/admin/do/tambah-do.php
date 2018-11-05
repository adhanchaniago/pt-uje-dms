<style>
	.selection{
		width: 100%;
	}
</style>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Tambah DO Baru</h5><hr>
				<form action="" method="POST" id="form-tambah-do">
					<p>Detail Delivery Order :</p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="do_no">Nomor DO</label>
								<input type="text" class="form-control" id="do_no" name="do_no" value="" required>
							</div>
							<div class="form-group">
								<label for="do_tanggal">Tanggal DO</label>
								<input type="text" class="form-control" id="do_tanggal" name="do_tanggal" value="" required>
							</div>
							<div class="form-group">
								<label for="partai">Partai (Ton)</label>
								<input type="text" class="form-control" id="partai" name="partai" value="" required>
							</div>
							<div class="form-group">
								<label for="nominal">Nominal (RP@KG)</label>
								<input type="text" class="form-control" id="nominal" name="nominal" value="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="kebun_id">Perkebunan Sawit (Asal)</label>
								<select class="form-control" name="kebun_id" id="kebun_id" required>
									<option value=""></option>
									<?php  
										$listKebun = [];
										$qKebun = "SELECT * FROM tb_kebun";
										$pKebun = mysqli_query($conn, $qKebun);
										while($rKebun = mysqli_fetch_array($pKebun)) {
											$listKebun[] = $rKebun;
										}
										foreach ($listKebun as $vKebun) {
											echo '<option value="'.$vKebun['id'].'">'.$vKebun['nama'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="pelabuhan_id">Pelabuhan Bongkar Muat (Tujuan)</label>
								<select class="form-control" name="pelabuhan_id" id="pelabuhan_id" required>
									<option value=""></option>
									<?php  
										$listPelabuhan = [];
										$qPelabuhan = "SELECT * FROM tb_pelabuhan";
										$pPelabuhan = mysqli_query($conn, $qPelabuhan);
										while($rPelabuhan = mysqli_fetch_array($pPelabuhan)) {
											$listPelabuhan[] = $rPelabuhan;
										}
										foreach ($listPelabuhan as $vPelabuhan) {
											echo '<option value="'.$vPelabuhan['id'].'">'.$vPelabuhan['nama'].'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="jenis">Jenis Barang</label>
								<select class="form-control" name="jenis" id="jenis" required>
									<option value=""></option>
									<option value="CPO">CPO</option>
								</select>
							</div>
						</div>
					</div>
					<br>
					<p>Detail Armada Yang Berangkat :</p>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<select class="form-control" name="armada_berangkat" id="armada_berangkat">
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
								<input type="text" class="form-control" id="tanggal_armada" name="tanggal_armada" value="" placeholder="Tanggal Berangkat" required>
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-success" id="btn-tambah-armada">Tambah Armada</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="partai_in_kg">Partai (KG)</label>
								<input type="text" class="form-control" id="partai_in_kg" name="partai_in_kg" value="0" readonly>
							</div>
						</div>
					</div><hr>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered" id="tb-armada-berjalan" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Plate No</th>
										<th>Nama Supir</th>
										<th>Tgl Berangkat</th>
										<th>Gross (KG)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td colspan="3">Total Gross</td>
										<td id="total_gross">0</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><br><hr>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" id="btn-tambah-do">SIMPAN DELIVERY ORDER</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>