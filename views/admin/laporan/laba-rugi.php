<style>
	.selection{
		width: 100%;
	}
</style>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Laporan Laba Rugi</h5><hr>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="bulan">Pilih Bulan</label>
							<select class="form-control" name="bulan" id="bulan" style="width: 100%;">
								<option value=""></option>
								<option value="1">Januari</option>
								<option value="2">Februari</option>
								<option value="3">Maret</option>
								<option value="4">April</option>
								<option value="5">Mei</option>
								<option value="6">Juni</option>
								<option value="7">Juli</option>
								<option value="8">Agustus</option>
								<option value="9">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
						</div>
						<div class="form-group">
							<label for="tahun">Pilih Tahun</label>
							<select class="form-control" name="tahun" id="tahun" style="width: 100%;">
								<option value=""></option>
								<option value="2018">2018</option>
								<option value="2019">2019</option>
							</select>
						</div><br>
						<div class="form-group">
							<button type="button" id="btn-cetak-laba-rugi" class="btn btn-primary btn-block"><i class="fa fa-print"></i>&nbsp;Cetak</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<?php include 'views/partials/rightbar.php'; ?>
	</div>
</div>