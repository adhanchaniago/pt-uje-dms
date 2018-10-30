<?php  

	session_start();

	require_once '../../../app/app.php';
	$conn = koneksi();

    $bulan = sanitizeThis($_GET['bulan']);
    $tahun = sanitizeThis($_GET['tahun']);

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../../../favicon.ico" type="image/x-icon">
        <title>PT. UJE - Laporan Laba-Rugi</title>
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
            #tabel-laba-rugi {
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
                    <p style="font-size: 16px;">
                        <strong>TABEL LAPORAN LABA RUGI</strong> <br>
                        <?php echo strtoupper($bulan_array[($bulan - 1)]).' '.$tahun ?>
                    </p>
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="tabel-laba-rugi">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">PLATE</th>
                                <th class="text-center">SUPIR</th>
                                <th class="text-center">BAN</th>
                                <th class="text-center">BAUT RODA</th>
                                <th class="text-center">BENEN</th>
                                <th class="text-center">OLI</th>
                                <th class="text-center">SELENDANG</th>
                                <th class="text-center">UANG JALAN</th>
                                <th class="text-center">TOTAL</th>
                                <th class="text-center">HASIL</th>
                                <th class="text-center">LABA/RUGI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  

                                $listSupirMobil = [];
                                $qSupirMobil = "
                                    SELECT tb_supir_mobil.id, tb_mobil.plate, tb_supir.nama FROM tb_supir_mobil, tb_mobil, tb_supir 
                                    WHERE tb_supir_mobil.supir_id = tb_supir.id AND tb_supir_mobil.mobil_id = tb_mobil.id 
                                ";
                                $pSupirMobil = mysqli_query($conn, $qSupirMobil);
                                while($rSupirMobil = mysqli_fetch_array($pSupirMobil)) {
                                    $listSupirMobil[] = $rSupirMobil;
                                }

                                $grandTotal = 0;
                                $grandHasil = 0;
                                $grandLabaRugi = 0;

                                foreach ($listSupirMobil as $kSupirMobil => $vSupirMobil) {

                                    $supir_mobil_id = $vSupirMobil['id'];

                                    $totalKendalaBan = 0;
                                    $listKendalaBan = [];
                                    $qKendalaBan = "
                                        SELECT id, biaya FROM tb_kendala WHERE supir_mobil_id = '$supir_mobil_id' 
                                        AND kendala = 'ban' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                                    ";
                                    $pKendalaBan = mysqli_query($conn, $qKendalaBan);
                                    while($rKendalaBan = mysqli_fetch_array($pKendalaBan)) {
                                        $listKendalaBan[] = $rKendalaBan;
                                    }

                                    foreach ($listKendalaBan as $vKendalaBan) {
                                        $totalKendalaBan = $totalKendalaBan + $vKendalaBan['biaya'];
                                    }

                                    //---------------------------------------------------------------------

                                    $totalKendalaBautRoda = 0;
                                    $listKendalaBautRoda = [];
                                    $qKendalaBautRoda = "
                                        SELECT id, biaya FROM tb_kendala WHERE supir_mobil_id = '$supir_mobil_id' 
                                        AND kendala = 'baut roda' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                                    ";
                                    $pKendalaBautRoda = mysqli_query($conn, $qKendalaBautRoda);
                                    while($rKendalaBautRoda = mysqli_fetch_array($pKendalaBautRoda)) {
                                        $listKendalaBautRoda[] = $rKendalaBautRoda;
                                    }

                                    foreach ($listKendalaBautRoda as $vKendalaBautRoda) {
                                        $totalKendalaBautRoda = $totalKendalaBautRoda + $vKendalaBautRoda['biaya'];
                                    }

                                    //---------------------------------------------------------------------
                                    
                                    $totalKendalaBenen = 0;
                                    $listKendalaBenen = [];
                                    $qKendalaBenen = "
                                        SELECT id, biaya FROM tb_kendala WHERE supir_mobil_id = '$supir_mobil_id' 
                                        AND kendala = 'benen' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                                    ";
                                    $pKendalaBenen = mysqli_query($conn, $qKendalaBenen);
                                    while($rKendalaBenen = mysqli_fetch_array($pKendalaBenen)) {
                                        $listKendalaBenen[] = $rKendalaBenen;
                                    }

                                    foreach ($listKendalaBenen as $vKendalaBenen) {
                                        $totalKendalaBenen = $totalKendalaBenen + $vKendalaBenen['biaya'];
                                    }

                                    //---------------------------------------------------------------------
                                    
                                    $totalKendalaOli = 0;
                                    $listKendalaOli = [];
                                    $qKendalaOli = "
                                        SELECT id, biaya FROM tb_kendala WHERE supir_mobil_id = '$supir_mobil_id' 
                                        AND kendala = 'oli' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                                    ";
                                    $pKendalaOli = mysqli_query($conn, $qKendalaOli);
                                    while($rKendalaOli = mysqli_fetch_array($pKendalaOli)) {
                                        $listKendalaOli[] = $rKendalaOli;
                                    }

                                    foreach ($listKendalaOli as $vKendalaOli) {
                                        $totalKendalaOli = $totalKendalaOli + $vKendalaOli['biaya'];
                                    }

                                    //---------------------------------------------------------------------
                                    
                                    $totalKendalaSelendang = 0;
                                    $listKendalaSelendang = [];
                                    $qKendalaSelendang = "
                                        SELECT id, biaya FROM tb_kendala WHERE supir_mobil_id = '$supir_mobil_id' 
                                        AND kendala = 'selendang' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'
                                    ";
                                    $pKendalaSelendang = mysqli_query($conn, $qKendalaSelendang);
                                    while($rKendalaSelendang = mysqli_fetch_array($pKendalaSelendang)) {
                                        $listKendalaSelendang[] = $rKendalaSelendang;
                                    }

                                    foreach ($listKendalaSelendang as $vKendalaSelendang) {
                                        $totalKendalaSelendang = $totalKendalaSelendang + $vKendalaSelendang['biaya'];
                                    }

                                    //---------------------------------------------------------------------
                                    

                                    $totalUangJalan = 0;
                                    $totalHasil = 0;
                                    $listPenghasilan = [];
                                    $qPenghasilan = "
                                        SELECT tb_spb.muat_total_muatan, tb_jalan.nominal 
                                        FROM tb_jalan, tb_jalan_detail, tb_spb WHERE tb_jalan_detail.jalan_id = tb_jalan.id 
                                        AND tb_spb.jalan_detail_id = tb_jalan_detail.id 
                                        AND tb_jalan_detail.supir_mobil_id = '$supir_mobil_id' 
                                        AND MONTH(tb_jalan.do_tanggal) = '$bulan' 
                                        AND YEAR(tb_jalan.do_tanggal) = '$tahun'
                                    ";
                                    $pPenghasilan = mysqli_query($conn, $qPenghasilan);
                                    while($rPenghasilan = mysqli_fetch_array($pPenghasilan)) {
                                        $listPenghasilan[] = $rPenghasilan;
                                    }

                                    foreach ($listPenghasilan as $vPenghasilan) {
                                        $hasil = $vPenghasilan['muat_total_muatan'] * $vPenghasilan['nominal'];
                                        $totalHasil = $totalHasil + $hasil;
                                        $uangJalan = $hasil * (55/100);
                                        $totalUangJalan = $totalUangJalan + $uangJalan;
                                    }

                                    $total = $totalKendalaBan + $totalKendalaBautRoda + $totalKendalaBenen + $totalKendalaOli + $totalKendalaSelendang + $totalUangJalan;

                                    $labaRugi = $totalHasil - $total;

                                    $grandTotal = $grandTotal + $total;
                                    $grandHasil = $grandHasil + $totalHasil;
                                    $grandLabaRugi = $grandLabaRugi + $labaRugi;

                            ?>

                                <tr>
                                    <td class="text-center"><?php echo $kSupirMobil + 1 ?></td>
                                    <td class="text-center"><?php echo $vSupirMobil['plate'] ?></td>
                                    <td class="text-center"><?php echo $vSupirMobil['nama'] ?></td>
                                    <td class="text-center"><?php echo number_format($totalKendalaBan) ?></td>
                                    <td class="text-center"><?php echo number_format($totalKendalaBautRoda) ?></td>
                                    <td class="text-center"><?php echo number_format($totalKendalaBenen) ?></td>
                                    <td class="text-center"><?php echo number_format($totalKendalaOli) ?></td>
                                    <td class="text-center"><?php echo number_format($totalKendalaSelendang) ?></td>
                                    <td class="text-center"><?php echo number_format($totalUangJalan) ?></td>
                                    <td class="text-center"><?php echo number_format($total) ?></td>
                                    <td class="text-center"><?php echo number_format($totalHasil) ?></td>
                                    <td class="text-center"><?php echo number_format($labaRugi) ?></td>
                                </tr>

                            <?php  
                                }
                            ?>

                            <tr>
                                <td></td>
                                <td colspan="8"><strong>GRAND TOTAL</strong></td>
                                <td class="text-center"><strong>IDR <?php echo number_format($grandTotal) ?></strong></td>
                                <td class="text-center"><strong>IDR <?php echo number_format($grandHasil) ?></strong></td>
                                <td class="text-center"><strong>IDR <?php echo number_format($grandLabaRugi) ?></strong></td>
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