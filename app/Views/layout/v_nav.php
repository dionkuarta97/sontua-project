<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-info">
        <div class="container">
            <a href="<?= base_url(); ?>/Admin" class="navbar-brand">

                <span class="brand-text font-weight-light">S W A L O W</span>
            </a>
            <?php if (session()->get('level') == 1) { ?>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Admin" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Kategori" class="nav-link">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Mitra" class="nav-link">Mitra</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Product
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/ProductBumnag/detail/<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php }; ?>
                            </div>

                        </li>



                    </ul>

                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <a href="<?= base_url(); ?>/Auth/logout" class="nav-link"><i class="fas fa-sign-out-alt"> Logout</i></a>
                </ul>
            <?php } else if (session()->get('level') == 2) {  ?>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/User" class="nav-link">Dashboard</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Product
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/User/detail/<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php }; ?>
                            </div>

                        </li>


                    </ul>

                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <a href="<?= base_url(); ?>/Auth/logout" class="nav-link"><i class="fas fa-sign-out-alt"> Logout</i></a>
                </ul>
            <?php } else if (session()->get('level') == 3) {  ?>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Kasir" class="nav-link">Dashboard</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Product
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/Kasir/list/<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></a>
                                    <div class="dropdown-divider"></div>
                                <?php }; ?>
                            </div>

                        </li>


                    </ul>

                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <a href="<?= base_url(); ?>/Auth/logout" class="nav-link"><i class="fas fa-sign-out-alt"> Logout</i></a>
                </ul>
            <?php }; ?>
        </div>
    </nav>