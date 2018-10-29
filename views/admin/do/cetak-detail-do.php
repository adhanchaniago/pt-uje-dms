<?php  
	session_start();
	require_once '../../../app/app.php';
	$conn = koneksi();
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
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
        <title>PT. UJE - Delivery Order</title>
        <link rel="stylesheet" href="../../../assets/vendors/bootstrap/css/bootstrap.min.css">
        <style>
        	body {

        	}
        </style>
    </head>
    <body>
    	<br>
        <div class="container">
        	<div class="row">
        		<div class="col-md-2">
        			<img src="../../../assets/img/logo1.png" width="100px">
        		</div>
        		<div class="col-md-10">
        			<h1>PT. USAHA JAYA EXPRESS</h1>
        			Jl. Olo Ladang No. 3 Padang 25116
        		</div>
        	</div>
        	<hr><br>
        	<div class="row">
        		<div class="col-md-12 text-center">
        			<h3>DELIVERY ORDER</h3>
        			No.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/UJ/PDG/VIII/<?php echo date('Y') ?>
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-md-12">
        			<p><strong>Detail Delivery Order :</strong></p>
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
        			</table><br>
        			<p><strong>Detail Perkebunan Sawit :</strong></p>
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
        			<p><strong>Detail Pelabuhan Bongkar Muat :</strong></p>
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
        			<p><strong>Detail Armada :</strong></p>
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
        					</tr>
        				</thead>
        				<tbody>
        					<?php
	        					$listDetail = [];
	        					$qDetail = "
		        					SELECT tb_jalan_detail.id AS detailID, tb_jalan_detail.tanggal_berangkat, tb_mobil.plate, 
                                    tb_mobil.merk, tb_mobil.gross, tb_supir.nama, tb_supir.sim_no, tb_supir.ktp_no
                                    FROM tb_jalan_detail, tb_supir_mobil, tb_mobil, tb_supir 
                                    WHERE tb_jalan_detail.supir_mobil_id = tb_supir_mobil.id AND tb_supir_mobil.mobil_id = tb_mobil.id  
                                    AND tb_supir_mobil.supir_id = tb_supir.id AND tb_jalan_detail.jalan_id = '$jalan_id'
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
        						</tr>
        					<?php
        						}
        					?>
        				</tbody>
        			</table>
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-md-9"></div>
        		<div class="col-md-3 text-center">
        			<p>Administrator,</p>
        			<br><br><br>
        			<p><?php echo strtoupper($dJalan['namaAdmin']) ?></p>
        		</div>
        	</div>
        </div>

        <script>
        	window.print();
        </script>
    </body>
</html>