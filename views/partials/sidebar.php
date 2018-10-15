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
        <!-- <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-copy"></i>
                Pages
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
            </ul>
        </li> -->
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
    </ul>
</nav>