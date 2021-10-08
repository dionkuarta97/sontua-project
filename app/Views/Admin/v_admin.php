<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">

            <div class="row">
                <?php foreach ($get_kategori as $key => $value) {; ?>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h5 align="center"><?= $value['kategori']; ?></h5>
                                <h3>aaa</h3>
                                <p>Orderan <br>
                                    <?= tanggal_indo(date('Y-m-d')); ?></p>
                            </div>


                            <a href="<?= base_url('User/list_order'); ?>" class="btn btn-info btn-block">More info <i class="fas fa-arrow-circle-right"></i></a>


                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h5 align="center"><?= $value['kategori']; ?></h5>
                                <h3>bb</h3>

                                <p>Orderan <br> <?= bulan_indo(date('Y-m')); ?></p>
                            </div>

                            <a href="<?= base_url('User/list_order'); ?>" class="btn btn-success btn-block">More info <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h5 align="center"><?= $value['kategori']; ?></h5>
                                <h5>ccc</h5>
                                <p>Pemasukan Hari ini <br>
                                    <?= tanggal_indo(date('Y-m-d')); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h5 align="center"><?= $value['kategori']; ?></h5>
                                <h5>dd</h5>
                                <p>Pemasukan Bulan <br> <?= bulan_indo(date('Y-m')); ?></p>
                            </div>
                        </div>
                    </div>

                <?php }; ?>
            </div>




        </div>
    </div>
</div>