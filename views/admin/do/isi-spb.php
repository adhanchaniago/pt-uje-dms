<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">
					Input Data SPB (Muat & Bongkar)
				</h5><hr>
				<?php  
					$detail_id = sanitizeThis($_GET['id']);
					$jalan_id = sanitizeThis($_GET['idx']);
				?>
				<form action="" method="POST" id="form-input-spb">
					<input type="hidden" name="jalan_detail_id" id="jalan_detail_id" value="<?php echo $detail_id ?>">
					<input type="hidden" name="jalan_id" id="jalan_id" value="<?php echo $jalan_id ?>">
					<div class="row">
						<div class="col-md-6">
							<p>SPB Muat</p>
							<div class="form-group">
								<label for="muat_tanggal">Tanggal Muat</label>
								<input type="text" class="form-control" id="muat_tanggal" name="muat_tanggal" value="" required>
							</div>
							<div class="form-group">
								<label for="muat_total_muatan">Total Muatan (KG)</label>
								<input type="text" class="form-control" id="muat_total_muatan" name="muat_total_muatan" value="" required>
							</div>
							<div class="form-group">
								<label for="muat_berat_keseluruhan">Berat Keseluruhan (KG)</label>
								<input type="text" class="form-control" id="muat_berat_keseluruhan" name="muat_berat_keseluruhan" value="" required>
							</div>
						</div>
						<div class="col-md-6">
							<p>SPB Bongkar</p>
							<div class="form-group">
								<label for="bongkar_tanggal">Tanggal Bongkar</label>
								<input type="text" class="form-control" id="bongkar_tanggal" name="bongkar_tanggal" value="" required>
							</div>
							<div class="form-group">
								<label for=bongkar_total_muatan">Total Muatan (KG)</label>
								<input type="text" class="form-control" id="bongkar_total_muatan" name="bongkar_total_muatan" value="" required>
							</div>
							<div class="form-group">
								<label for="bongkar_berat_keseluruhan">Berat Keseluruhan (KG)</label>
								<input type="text" class="form-control" id="bongkar_berat_keseluruhan" name="bongkar_berat_keseluruhan" value="" required>
							</div>
						</div>
					</div><hr>
					<div class="row">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-primary" id="btn-input-spb">Simpan Data</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>