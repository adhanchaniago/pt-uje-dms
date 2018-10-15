 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <button type="button" id="sidebarCollapse" class="btn" style="background: #2980B9; color: #fff; border-color: #2980B9;">
            <i class="fas fa-align-left"></i>
        </button>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item <?php echo ($_GET['page'] == 'profile')?'active':''; ?>">
                    <a class="nav-link" href="?page=profile">PROFILE</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#logout" id="btn-logout">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>