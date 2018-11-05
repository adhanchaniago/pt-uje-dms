<?php  
	session_start();
	require_once '../../../app/app.php';
	$conn = koneksi();
	$detail_id = sanitizeThis($_GET['id']);
	$listDetail = [];
	$qDetail = "
		SELECT tb_jalan_detail.id AS detailID, tb_jalan_detail.tanggal_berangkat, 
		tb_mobil.plate, tb_mobil.merk, tb_mobil.jenis AS jenisMobil, tb_mobil.gross, tb_mobil.foto AS fotoMobil, 
		tb_supir.nama AS namaSupir, tb_supir.tempat_lahir, tb_supir.tanggal_lahir, tb_supir.telepon, tb_supir.jenis_kelamin, 
		tb_supir.sim_no, tb_supir.sim_img, tb_supir.ktp_no, tb_supir.ktp_img, 
		tb_jalan.do_no, tb_jalan.do_tanggal, tb_jalan.partai, tb_jalan.jenis, tb_jalan.nominal, 
		tb_kebun.nama AS namaKebun, tb_user.nama AS namaAdmin 
		FROM tb_jalan_detail, tb_supir_mobil, tb_mobil, tb_supir, tb_jalan, tb_kebun, tb_user 
        WHERE tb_jalan_detail.supir_mobil_id = tb_supir_mobil.id AND tb_supir_mobil.mobil_id = tb_mobil.id 
        AND tb_supir_mobil.supir_id = tb_supir.id AND tb_jalan_detail.jalan_id = tb_jalan.id AND tb_jalan.kebun_id = tb_kebun.id
		AND tb_jalan.user_id = tb_user.id AND tb_jalan_detail.id = '$detail_id'
	";
	$pDetail = mysqli_query($conn, $qDetail) or die(mysqli_error($conn));
	$dDetail = mysqli_fetch_assoc($pDetail);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
        <title>PT. UJE - Surat Pengantar</title>
        <link rel="stylesheet" href="../../../assets/vendors/bootstrap/css/bootstrap.min.css">
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
        			<h3>SURAT PENGANTAR</h3>
        			No.  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/UJ/PDG/VIII/<?php echo date('Y') ?>
        		</div>
        	</div>
        	<br>
        	<div class="row">
        		<div class="col-md-12">
        			KEPADA YTH. : <strong><?php echo strtoupper($dDetail['namaKebun']) ?></strong>
        		</div>
        	</div><br>
        	<div class="row">
        		<div class="col-md-12">
        			<p><strong>Detail Delivery Order :</strong></p>
        			<table>
        				<tr>
        					<td width="150px">Nomor</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['do_no'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Tanggal</td>
        					<td>:</td>
        					<td><strong><?php echo date('d/m/Y', strtotime($dDetail['do_tanggal'])) ?></strong></td>
        				</tr>
        				<tr>
        					<td>Jenis</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['jenis'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Partai</td>
        					<td>:</td>
        					<td><strong><?php echo number_format($dDetail['partai']).' TON / '.number_format($dDetail['partai']*1000).' KG' ?></strong></td>
        				</tr>
        			</table>
        		</div>
        	</div><br>
        	<div class="row">
        		<div class="col-md-12">
        			<p><strong>Detail Mobil</strong></p>
        			<table>
        				<tr>
        					<td width="150px">Plate No</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['plate'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Merk</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['merk'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Jenis</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['jenisMobil'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Gross</td>
        					<td>:</td>
        					<td><strong><?php echo number_format($dDetail['gross']) ?> KG</strong></td>
        				</tr>
        			</table>
        		</div>
        	</div><br>
        	<div class="row">
        		<div class="col-md-12">
        			<p><strong>Detail Supir</strong></p>
        			<table>
        				<tr>
        					<td width="150px">KTP No</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['ktp_no'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>SIM No</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['sim_no'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Nama</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['namaSupir'] ?></strong></td>
        				</tr>
        				<tr>
        					<td>Jekel</td>
        					<td>:</td>
        					<td><strong><?php echo ucfirst($dDetail['jenis_kelamin']) ?></strong></td>
        				</tr>
        				<!-- <tr>
        					<td>TTL</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['tempat_lahir'].', '.date('d/m/Y', strtotime($dDetail['tanggal_lahir'])) ?></strong></td>
        				</tr> -->
        				<tr>
        					<td>Telepon</td>
        					<td>:</td>
        					<td><strong><?php echo $dDetail['telepon'] ?></strong></td>
        				</tr>
        			</table>
        		</div>
        	</div><br><br>
        	<div class="row">
        		<div class="col-md-4 text-center">
        			<p>Yang Mengirim,</p>
        			<br><br><br>
        			<p><?php echo strtoupper($dDetail['namaAdmin']) ?></p>
        		</div>
        		<div class="col-md-4 text-center">
        			<p>Supir,</p>
        			<br><br><br>
        			<p><?php echo strtoupper($dDetail['namaSupir']) ?></p>
        		</div>
        		<div class="col-md-4 text-center">
        			<p>Yang Menerima,</p>
        		</div>
        	</div><br><br>
        	<p>Lampiran :</p>
        	<div class="row">
        		<div class="col-md-4 text-center">
        			<!-- <p><strong>Foto KTP</strong></p> -->
        			<img src="../../../assets/img/ktp/<?php echo $dDetail['ktp_img'] ?>" width="250px;">
        		</div>
        		<div class="col-md-4 text-center">
        			<!-- <p><strong>Foto SIM</strong></p> -->
        			<img src="../../../assets/img/sim/<?php echo $dDetail['sim_img'] ?>" width="250px;">
        		</div>
        		<div class="col-md-4 text-center">
        			<!-- <p><strong>Foto Mobil</strong></p> -->
        			<img src="../../../assets/img/mobil/<?php echo $dDetail['fotoMobil'] ?>" width="250px;">
        		</div>
        	</div>
        </div>
		

        <script>
        	window.print();
        </script>
    </body>
</html>