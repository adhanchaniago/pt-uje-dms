<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Daftar Delivery Order (DO)</h5><hr>
				<a href="?page=tambah-do" target="_blank" class="btn btn-primary">Tambah DO Baru</a><br><br>
				<table id="table-data-do" class="table table-bordered display responsive nowrap" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>No DO</th>
							<th>Tanggal</th>
							<th>Partai</th>
							<th>Status</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$list_data = [];
							$query = "SELECT * FROM tb_jalan";
							$process = mysqli_query($conn, $query);
							while($row = mysqli_fetch_array($process)) {
								$list_data[] = $row;
							}

							foreach ($list_data as $key => $value) {
						?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['do_no'] ?></td>
								<td><?php echo date('d/m/Y', strtotime($value['do_tanggal'])) ?></td>
								<td><?php echo number_format($value['partai']) ?> KG</td>
								<td><?php echo $value['status'] == '0' ? 'Ongoing' : 'Finished' ?></td>
								<td>
									<div class="btn-group">
										<a href="?page=detail-do&id=<?php echo $value['id'] ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-clipboard-list"></i>&nbsp;Detail DO</a>
										<?php if ($hak_akses == 'admin'): ?>
											<button type="button" class="btn btn-danger btn-sm <?php echo $value['status'] == '1' ? 'disabled' : '' ?>" onclick="ubahStatusDO(<?php echo $value['id'].','.$value['status'] ?>)"><i class="fa fa-check-square"></i>&nbsp;Finished</button>
										<?php endif ?>
										<button type="button" class="btn btn-primary btn-sm" onclick="window.open(window.location.origin+'/'+'views/admin/do/cetak-laporan-spb.php?id=<?php echo $value['id'] ?>', '_blank', 'location=yes, height=570, width=1000, scrollbars=yes, status=yes');">
											<i class="fa fa-print"></i>&nbsp;Laporan SPB 
										</button>
										<button type="button" class="btn btn-danger btn-sm btn-hapus-do" onclick="deleteDataDO(<?php echo $value['id'] ?>)"><i class="fa fa-eraser"></i>&nbsp;HAPUS</button>
									</div>
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