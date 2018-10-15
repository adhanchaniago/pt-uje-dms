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
                Kelola Supir
            </a>
        </li>
        <li class="<?php echo ($_GET['page'] == 'mobil')?'active':''; ?>">
            <a href="?page=mobil">
                <i class="fa fa-fw fa-car"></i>
                Kelola Mobil
            </a>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-fw fa-paper-plane"></i>
                Contact
            </a>
        </li>
    </ul>
</nav>