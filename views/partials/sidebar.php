<nav id="sidebar">
    <div class="sidebar-header text-center">
        <img src="assets/img/logo2.png" width="150px;"">
        <!-- <h3>Control Panel</h3> -->
        <strong>CP</strong>
    </div>
    <ul class="list-unstyled components">
        <li class="<?php echo ($_GET['page'] == 'home')?'active':''; ?>">
            <a href="?page=home">
                <i class="fa fa-fw fa-home"></i> 
                Home
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'supir')?'active':''; ?>">
            <a href="?page=supir">
                <i class="fa fa-fw fa-user"></i> 
                Data Supir
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'mobil')?'active':''; ?>">
            <a href="?page=mobil">
                <i class="fa fa-fw fa-truck"></i>
                Data Mobil
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'supir_mobil')?'active':''; ?>">
            <a href="?page=supir_mobil">
                <i class="fa fa-fw fa-user-tag"></i>
                Data Supir Mobil
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'kebun')?'active':''; ?>">
            <a href="?page=kebun">
                <i class="fa fa-fw fa-tree"></i>
                Data Kebun Sawit
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'pelabuhan')?'active':''; ?>">
            <a href="?page=pelabuhan">
                <i class="fa fa-fw fa-warehouse"></i>
                Data Pelabuhan
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'kendala')?'active':''; ?>">
            <a href="?page=kendala">
                <i class="fa fa-fw fa-exclamation-circle"></i>
                Data Kendala
            </a>
        </li>
        <?php  
            if ($_GET['page'] == 'tambah-do' || $_GET['page'] == 'daftar-do') {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
        ?>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-fw fa-truck-moving"></i>
                Delivery Order
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <?php if ($hak_akses == 'admin'): ?>
                    <li>
                        <a href="?page=tambah-do">Tambah DO</a>
                    </li>
                <?php endif ?>
                <li>
                    <a href="?page=daftar-do">Daftar DO</a>
                </li>
            </ul>
        </li>
        <?php  
            if ($_GET['page'] == 'pendapatan-supir' || $_GET['page'] == 'laba-rugi') {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
        ?>
            <a href="#pageLaporan" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fa fa-sw fa-folder"></i>
                Laporan
            </a>
            <ul class="collapse list-unstyled" id="pageLaporan">
                <li>
                    <a href="?page=pendapatan-supir">Pendapatan Supir</a>
                </li>
                <li>
                    <a href="?page=laba-rugi">Laba Rugi</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>