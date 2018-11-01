<?php  
	session_start();
	require_once '../../../app/app.php';
	$conn = koneksi();
	$jalan_id = sanitizeThis($_GET['id']);
	$qJalan = "
		SELECT tb_jalan.id AS jalanID, tb_jalan.do_no, tb_jalan.do_tanggal, tb_jalan.partai, tb_jalan.jenis, tb_jalan.nominal, tb_jalan.status, 
		tb_user.nama AS namaAdmin, tb_kebun.nama AS namaKebun, tb_kebun.alamat AS alamatKebun, tb_kebun.telepon AS teleponKebun, tb_kebun.toleransi, 
		tb_pelabuhan.nama AS namaPelabuhan, tb_pelabuhan.alamat AS alamatPelabuhan, tb_pelabuhan.telepon AS teleponPelabuhan 
		FROM tb_jalan, tb_user, tb_kebun, tb_pelabuhan WHERE tb_jalan.user_id = tb_user.id AND tb_jalan.kebun_id = tb_kebun.id 
		AND tb_jalan.pelabuhan_id = tb_pelabuhan.id AND tb_jalan.id = '$jalan_id'
	";
	$pJalan = mysqli_query($conn, $qJalan);
	$dJalan = mysqli_fetch_assoc($pJalan);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
        <title>PT. UJE - Laporan SPB</title>
        <link rel="stylesheet" href="../../../assets/vendors/bootstrap/css/bootstrap.min.css">
        <style>
        	body {
        		font-size: 12px;
        	}
        	@media print {
        		@page {
        			size: landscape;
        		}
        	}
        	.tabel-data {
        		font-size: 10px;
        	}
        </style>
    </head>
    <body>
    	<br>
    	<div class="container">
    	<div class="row">
    		<div class="col-md-12 text-center">
    			<img src="../../../assets/img/logo2.png" width="100px"><br><br>
    			<p style="font-size: 16px;"><strong>LAPORAN SPB MUAT & BONGKAR</strong></p>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-6">
    			<table>
    				<tr>
    					<td width="150px">Nomor DO</td>
    					<td>:</td>
    					<td><strong><?php echo $dJalan['do_no'] ?></strong></td>
    				</tr>
    				<tr>
    					<td>Tanggal DO</td>
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
    					<td><strong><?php echo number_format($dJalan['nominal']) ?> @KG</strong></td>
    				</tr>
    			</table><br>
    		</div>
    		<div class="col-md-6">
    			<table>
    				<tr>
    					<td width="150px">Perkebunan Sawit</td>
    					<td>:</td>
    					<td><strong><?php echo $dJalan['namaKebun'] ?></strong></td>
    				</tr>
    				<tr>
    					<td>Pelabuhan Bongkar Muat</td>
    					<td>:</td>
    					<td><strong><?php echo $dJalan['namaPelabuhan'] ?></strong></td>
    				</tr>
    				<tr>
    					<td width="150px">Toleransi</td>
    					<td>:</td>
    					<td><strong><?php echo $dJalan['toleransi'] ?></strong> %</td>
    				</tr>
    			</table>
    		</div>
    	</div><br>
    	<div class="row">
    		<div class="col-md-12 tabel-data">
    			<table class="table table-bordered">
    				<thead>
    					<tr>
    						<th class="text-center" rowspan="2">#</th>
    						<th class="text-center" rowspan="2">PLATE</th>
    						<th class="text-center" rowspan="2">DRIVER</th>
    						<th class="text-center" colspan="4">MUAT</th>
    						<th class="text-center" colspan="4">BONGKAR</th>
    						<th class="text-center" colspan="2">KLEM</th>
    					</tr>
    					<tr>
                            <th class="text-center">NO SPB</th>
    						<th class="text-center">TANGGAL</th>
    						<th class="text-center">MUATAN</th>
    						<th class="text-center">NOMINAL</th>
                            <th class="text-center">NO SPB</th>
    						<th class="text-center">TANGGAL</th>
    						<th class="text-center">MUATAN</th>
    						<th class="text-center">NOMINAL</th>
    						<th class="text-center">TOTAL</th>
    						<th class="text-center">NOMINAL</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
        					$listDetail = [];
        					$qDetail = "
	        					SELECT tb_jalan_detail.id AS detailID, tb_mobil.plate, tb_supir.nama AS namaSupir, tb_spb.muat_tanggal, tb_spb.muat_total_muatan, tb_spb.bongkar_tanggal, tb_spb.bongkar_total_muatan, tb_spb.muat_no_spb, tb_Spb.bongkar_no_spb 
	        					FROM tb_jalan_detail, tb_supir_mobil, tb_mobil, tb_supir, tb_spb 
                                WHERE tb_jalan_detail.supir_mobil_id = tb_supir_mobil.id AND tb_supir_mobil.supir_id = tb_supir.id 
                                AND tb_supir_mobil.mobil_id = tb_mobil.id AND tb_spb.jalan_detail_id = tb_jalan_detail.id 
	        					AND tb_jalan_detail.jalan_id = '$jalan_id'
        					";
        					$pDetail = mysqli_query($conn, $qDetail);
        					while($rDetail = mysqli_fetch_array($pDetail)) {
        						$listDetail[] = $rDetail;
        					}
        					$muat_total_keseluruhan = 0;
        					$muat_nominal_keseluruhan = 0;
        					$bongkar_total_keseluruhan = 0;
        					$bongkar_nominal_keseluruhan = 0;
        					$klem_total_keseluruhan = 0;
        					$klem_nominal_keseluruhan = 0;
        					foreach ($listDetail as $key => $vDetail) {
    					?>
    						<tr>
    							<td class="text-center"><?php echo $key+1 ?></td>
    							<td class="text-center"><?php echo $vDetail['plate'] ?></td>
    							<td class="text-center"><?php echo $vDetail['namaSupir'] ?></td>
                                <td class="text-center"><?php echo $vDetail['muat_no_spb'] ?></td>
    							<td class="text-center"><?php echo date('d/m/Y', strtotime($vDetail['muat_tanggal'])) ?></td>
    							<td class="text-center"><?php echo number_format($vDetail['muat_total_muatan']) ?> KG</td>
    							<td class="text-center">IDR <?php echo number_format($nominal_muat = $vDetail['muat_total_muatan'] * $dJalan['nominal']) ?></td>
                                <td class="text-center"><?php echo $vDetail['bongkar_no_spb'] ?></td>
    							<td class="text-center"><?php echo date('d/m/Y', strtotime($vDetail['bongkar_tanggal'])) ?></td>
    							<td class="text-center"><?php echo number_format($vDetail['bongkar_total_muatan']) ?> KG</td>
    							<td class="text-center">IDR <?php echo number_format($nominal_bongkar = $vDetail['bongkar_total_muatan'] * $dJalan['nominal']) ?></td>
    							<?php
    								$selisih_muatan = $vDetail['muat_total_muatan'] - $vDetail['bongkar_total_muatan'];
    								$total_toleransi = ($dJalan['toleransi']/100) * $vDetail['muat_total_muatan'];
    								$klem = $selisih_muatan - $total_toleransi;
    								if ($klem < 0) {
    									$klem = 0;
    								}
    								$muat_total_keseluruhan = $muat_total_keseluruhan + $vDetail['muat_total_muatan'];
    								$muat_nominal_keseluruhan = $muat_nominal_keseluruhan + $nominal_muat;
    								$bongkar_total_keseluruhan = $bongkar_total_keseluruhan + $vDetail['bongkar_total_muatan'];
    								$bongkar_nominal_keseluruhan = $bongkar_nominal_keseluruhan + $nominal_bongkar;
    							?>
    							<td class="text-center"><?php echo number_format($klem) ?> KG</td>
    							<td class="text-center">IDR <?php echo number_format($nominal_klem = $klem * $dJalan['nominal']) ?></td>
    							<?php  
    								$klem_total_keseluruhan = $klem_total_keseluruhan + $klem;
    								$klem_nominal_keseluruhan = $klem_nominal_keseluruhan + $nominal_klem;
    							?>
    						</tr>
    					<?php
    						}
    					?>
    					<tr>
    						<td></td>
    						<td colspan="2"><strong>TOTAL</strong></td>
    						<td></td>
                            <td></td>
    						<td class="text-center"><strong><?php echo number_format($muat_total_keseluruhan) ?> KG</strong></td>
    						<td class="text-center"><strong>IDR <?php echo number_format($muat_nominal_keseluruhan) ?></strong></td>
    						<td></td>
                            <td></td>
    						<td class="text-center"><strong><?php echo number_format($bongkar_total_keseluruhan) ?> KG</strong></td>
    						<td class="text-center"><strong>IDR <?php echo number_format($bongkar_nominal_keseluruhan) ?></strong></td>
    						<td class="text-center"><strong><?php echo number_format($klem_total_keseluruhan) ?> KG</strong></td>
    						<td class="text-center"><strong>IDR <?php echo number_format($klem_nominal_keseluruhan) ?></strong></td>
    					</tr>
    				</tbody>
    			</table>
    		</div>
    	</div><br><br>
    	<div class="row">
    		<div class="col-md-8"></div>
    		<div class="col-md-4 text-center">
    			<p>ADMINISTRATOR,</p>
    			<br><br>
    			<p><strong><?php echo strtoupper($dJalan['namaAdmin']) ?></strong></p>
    		</div>
    	</div>
        
        <script>
        	window.print();
        </script>
    </body>
</html>