<?php  

	session_start();

	require_once '../../../app/app.php';
	$conn = koneksi();

	$supir_mobil_id = sanitizeThis($_GET['id']);
    $bulan = sanitizeThis($_GET['bulan']);
    $tahun = sanitizeThis($_GET['tahun']);

	$qSupirMobil = "
		SELECT tb_mobil.plate, tb_mobil.merk, tb_mobil.jenis, tb_mobil.gross, tb_supir.nama, tb_supir.jenis_kelamin, 
        tb_supir.tempat_lahir, tb_supir.tanggal_lahir, tb_supir.ktp_no, tb_supir.sim_no, tb_supir.telepon
        FROM tb_supir_mobil, tb_mobil, tb_supir WHERE tb_supir_mobil.mobil_id = tb_mobil.id 
        AND tb_supir_mobil.supir_id = tb_supir.id AND tb_supir_mobil.id = '$supir_mobil_id'
	";
	$pSupirMobil = mysqli_query($conn, $qSupirMobil);
	$dSupirMobil = mysqli_fetch_assoc($pSupirMobil);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
        <title>PT. UJE - Laporan Pendapatan Supir</title>
        <link rel="stylesheet" href="../../../assets/vendors/bootstrap/css/bootstrap.min.css">
        <style>
            body {
                font-size: 12px;
            }
        </style>
    </head>
    <body>
    	<br>
        <div class="container">
        	<div class="row">
                <div class="col-md-12 text-center">
                    <img src="../../../assets/img/logo2.png" width="100px"><br><br>
                    <p style="font-size: 16px;">
                        <strong>LAPORAN PENDAPATAN SUPIR</strong> <br>
                        <?php echo strtoupper($bulan_array[($bulan - 1)]).' '.$tahun ?>
                    </p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td width="150px">Plate No</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['plate'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>Merk</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['merk'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>Jenis</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['jenis'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>Gross</td>
                            <td>:</td>
                            <td><strong><?php echo number_format($dSupirMobil['gross']) ?> KG</strong></td>
                        </tr>
                    </table><br>
                </div>
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td width="150px">KTP No</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['ktp_no'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>SIM No</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['sim_no'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['nama'] ?></strong></td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td>:</td>
                            <td><strong><?php echo $dSupirMobil['tempat_lahir'].', '.date('d/m/Y', strtotime($dSupirMobil['tanggal_lahir'])) ?></strong></td>
                        </tr>
                    </table><br>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">NO DO</th>
                                <th class="text-center">TANGGAL DO</th>
                                <th class="text-center">MUATAN (KG)</th>
                                <th class="text-center">BIAYA @ (IDR)</th>
                                <th class="text-center">HASIL (IDR)</th>
                                <th class="text-center">UANG JALAN (IDR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  

                                $listDetail = [];
                                $query = "
                                    SELECT tb_jalan.do_no, tb_jalan.do_tanggal, tb_spb.muat_total_muatan, tb_jalan.nominal 
                                    FROM tb_jalan, tb_jalan_detail, tb_spb WHERE tb_jalan_detail.jalan_id = tb_jalan.id 
                                    AND tb_spb.jalan_detail_id = tb_jalan_detail.id 
                                    AND tb_jalan_detail.supir_mobil_id = '$supir_mobil_id' 
                                    AND MONTH(tb_jalan.do_tanggal) = '$bulan' 
                                    AND YEAR(tb_jalan.do_tanggal) = '$tahun'
                                ";
                                $process = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                while($row = mysqli_fetch_array($process)) {
                                    $listDetail[] = $row;
                                }

                                $hasilTotal = 0;
                                $jalanTotal = 0;

                                foreach ($listDetail as $key => $value) {
                                
                            ?>
                                
                                <tr>
                                    <td class="text-center"><?php echo $key+1 ?></td>
                                    <td class="text-center"><?php echo $value['do_no'] ?></td>
                                    <td class="text-center"><?php echo date('d/m/Y', strtotime($value['do_tanggal'])) ?></td>
                                    <td class="text-center"><?php echo number_format($value['muat_total_muatan']) ?></td>
                                    <td class="text-center"><?php echo number_format($value['nominal']) ?></td>
                                    <td class="text-center"><?php echo number_format($hasil = $value['nominal'] * $value['muat_total_muatan']) ?></td>
                                    <td class="text-center"><?php echo number_format($uJalan = $hasil * (55/100)) ?></td>
                                </tr>

                            <?php
                                    $hasilTotal = $hasilTotal + $hasil;
                                    $jalanTotal = $jalanTotal + $uJalan;
                                }
                            ?>

                            <tr>
                                <td></td>
                                <td colspan="4"><strong>TOTAL</strong></td>
                                <td class="text-center"><strong>IDR <?php echo number_format($hasilTotal) ?></strong></td>
                                <td class="text-center"><strong>IDR <?php echo number_format($jalanTotal) ?></strong></td>
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
                    <p><strong><?php echo strtoupper(getProfile()['nama']) ?></strong></p>
                </div>
            </div>
        </div>

        <script>
        	window.print();
        </script>
    </body>
</html>