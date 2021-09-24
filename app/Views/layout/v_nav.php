<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-info">
        <div class="container">
            <a href="<?= base_url(); ?>/Admin" class="navbar-brand">

                <span class="brand-text font-weight-light">S W A L O W</span>
            </a>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <?php if (session()->get('level') == 1) { ?>
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
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Lainnya</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Product Bumnag</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <?php foreach ($get_kategori as $key => $value) { ?>
                                            <li>
                                                <a tabindex="-1" href="<?= base_url(); ?>/ProductBumnag/detail/<?= $value['id_kategori']; ?>" class="dropdown-item"><?= $value['kategori']; ?></a>
                                            </li>
                                        <?php }; ?>
                                        <!-- Level three dropdown-->

                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>

                    </ul>

            </div>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <a href="<?= base_url(); ?>/Auth/logout" class="nav-link"><i class="fas fa-sign-out-alt"> Logout</i></a>
            </ul>
        <?php } else if (session()->get('level') == 2) {  ?>
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="<?= base_url(); ?>/Admin" class="nav-link">Dashboard</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Lainnya</a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">

                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Product</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <?php foreach ($get_kategori as $key => $value) { ?>
                                    <li>
                                        <a tabindex="-1" href="<?= base_url(); ?>/User/detail/<?= $value['id_kategori']; ?>" class="dropdown-item"><?= $value['kategori']; ?></a>
                                    </li>
                                <?php }; ?>
                                <!-- Level three dropdown-->

                        </li>
                        <!-- End Level two -->
                    </ul>
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