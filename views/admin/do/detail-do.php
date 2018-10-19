<?php  

	$jalan_id = sanitizeThis($_GET['id']);
	$qJalan = "
		SELECT tb_jalan.id AS jalanID, tb_jalan.do_no, tb_jalan.do_tanggal, tb_jalan.partai, tb_jalan.jenis, tb_jalan.nominal, tb_jalan.status, 
		tb_user.nama AS namaAdmin, tb_kebun.nama AS namaKebun, tb_kebun.alamat AS alamatKebun, tb_kebun.telepon AS teleponKebun, 
		tb_pelabuhan.nama AS namaPelabuhan, tb_pelabuhan.alamat AS alamatPelabuhan, tb_pelabuhan.telepon AS teleponPelabuhan 
		FROM tb_jalan, tb_user, tb_kebun, tb_pelabuhan WHERE tb_jalan.user_id = tb_user.id AND tb_jalan.kebun_id = tb_kebun.id 
		AND tb_jalan.pelabuhan_id = tb_pelabuhan.id AND tb_jalan.id = '$jalan_id'
	";
	$pJalan = mysqli_query($conn, $qJalan);
	$dJalan = mysqli_fetch_assoc($pJalan);

?>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<div class="text-center">
					<h5 class="card-title">
						<strong>DELIVERY ORDER</strong> 
						<button class="btn btn-success btn-sm float-right" onclick="window.open(window.location.origin+'/'+'views/admin/do/cetak-detail-do.php?id=<?php echo $jalan_id ?>', '_blank', 'location=yes, height=570, width=1000, scrollbars=yes, status=yes');">
							<i class="fa fa-print"></i> Cetak DO
						</button>
					</h5><hr>
				</div>
				<p>Detail DO :</p>
				<table>
					<tr>
						<td width="150px">Nomor</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['do_no'] ?></strong></td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td><strong><?php echo date('d/m/Y', strtotime($dJalan['do_tanggal'])) ?></strong></td>
					</tr>
					<tr>
						<td>Jenis</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['jenis'] ?></strong></td>
					</tr>
					<tr>
						<td>Partai</td>
						<td>:</td>
						<td><strong><?php echo number_format($dJalan['partai']) ?> KG</strong></td>
					</tr>
					<tr>
						<td>Nominal</td>
						<td>:</td>
						<td><strong>IDR <?php echo number_format($dJalan['nominal'], 2) ?> /KG</strong></td>
					</tr>
					<tr>
						<td>Status</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['status'] == '0' ? 'Ongoing' : 'Finished' ?></strong></td>
					</tr>
				</table><br>
				<p>Detail Perkebunan Sawit :</p>
				<table>
					<tr>
						<td width="150px">Nama</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['namaKebun'] ?></strong></td>
					</tr>
					<tr>
						<td width="150px">Alamat</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['alamatKebun'] ?></strong></td>
					</tr>
					<tr>
						<td width="150px">Telepon</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['teleponKebun'] ?></strong></td>
					</tr>
				</table><br>
				<p>Detail Pelabuhan Bongkar Muat :</p>
				<table>
					<tr>
						<td width="150px">Nama</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['namaPelabuhan'] ?></strong></td>
					</tr>
					<tr>
						<td width="150px">Alamat</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['alamatPelabuhan'] ?></strong></td>
					</tr>
					<tr>
						<td width="150px">Telepon</td>
						<td>:</td>
						<td><strong><?php echo $dJalan['teleponPelabuhan'] ?></strong></td>
					</tr>
				</table><br>
				<p>Detail Armada Yang Berjalan :</p>
				<table class="table table-bordered display responsive nowrap" id="tabel-list-armada">
					<thead>
						<tr>
							<th>#</th>
							<th>Plate No</th>
							<th>Merk</th>
							<th>Gross</th>
							<th>No SIM</th>
							<th>Nama Supir</th>
							<th>Tgl Berangkat</th>
							<th>SPB</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$listDetail = [];
							$qDetail = "
								SELECT tb_jalan_detail.id AS detailID, tb_jalan_detail.tanggal_berangkat, tb_mobil.plate, tb_mobil.merk, 
								tb_mobil.gross, tb_supir.nama, tb_supir.sim_no
								FROM tb_jalan_detail, tb_mobil, tb_supir WHERE tb_jalan_detail.mobil_id = tb_mobil.id 
								AND tb_mobil.supir_id = tb_supir.id AND tb_jalan_detail.jalan_id = '$jalan_id'
							";
							$pDetail = mysqli_query($conn, $qDetail);
							while($rDetail = mysqli_fetch_array($pDetail)) {
								$listDetail[] = $rDetail;
							}
							foreach ($listDetail as $key => $vDetail) {
						?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $vDetail['plate'] ?></td>
								<td><?php echo $vDetail['merk'] ?></td>
								<td><?php echo number_format($vDetail['gross']) ?> KG</td>
								<td><?php echo $vDetail['sim_no'] ?></td>
								<td><?php echo $vDetail['nama'] ?></td> 
								<td><?php echo date('d M Y', strtotime($vDetail['tanggal_berangkat'])) ?></td>
								<td><?php echo checkSPB($vDetail['detailID']) == '0' ? 'Belum' : 'Sudah' ?></td>
								<td>
									<button class="btn btn-success btn-sm" onclick="window.open(window.location.origin+'/'+'views/admin/do/cetak-pengantar.php?id=<?php echo $vDetail['detailID'] ?>', '_blank', 'location=yes, height=570, width=1000, scrollbars=yes, status=yes');">
										<i class="fa fa-print"></i> Cetak Surat Pengantar
									</button>
									<a href="?page=isi-spb&id=<?php echo $vDetail['detailID'].'&idx='.$jalan_id ?>" class="btn btn-primary btn-sm <?php echo checkSPB($vDetail['detailID']) == '0' ? '' : 'disabled' ?>">Isi SPB</a>
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