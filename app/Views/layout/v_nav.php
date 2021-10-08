<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
        <div class="container">
            <a href="<?= base_url(); ?>/Admin" class="navbar-brand">

                <span class="brand-text font-weight-light"><b>S O N T U A</b></span>
            </a>
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php if (session()->get('level') == 1) { ?>
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Admin" class="nav-link"><b>Dashboard</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Kategori" class="nav-link"><b>Kategori</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Mitra" class="nav-link"><b>Mitra</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Admin/kasir" class="nav-link"><b>Kasir</b></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/Admin/akun" class="nav-link"><b>Akun</b></a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b>List Product</b>
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
                            <a href="<?= base_url("User/dashboard"); ?>" class="nav-link"><b>Dashboard</b></a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                List Product
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/User/detail"><?= $value['kategori']; ?></a>
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
                            <a href="<?= base_url(); ?>/Kasir" class="nav-link"><b>Dashboard</b></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b> List Pembeli</b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <a class="dropdown-item" href="<?= base_url(); ?>/Kasir/pembeli/<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></a>
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