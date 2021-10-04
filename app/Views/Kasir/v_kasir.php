<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <?php $i = 0;
                        foreach ($get_kategori as $key => $value) { ?>
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">Rp. <?= format_rupiah($total_harga_lunas[$i++]); ?></h5>
                                    <span class="badge badge-success"><?= $value['kategori']; ?> (Sudah Bayar)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        <?php }; ?>
                        <?php $i = 0;
                        foreach ($get_kategori as $key => $value) { ?>
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">Rp. <?= format_rupiah($total_harga_bayar[$i++]); ?></h5>
                                    <span class="badge badge-warning"><?= $value['kategori']; ?> (Belum Bayar)</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        <?php }; ?>
                    </div>

                </div>
            </div>


            <div style="margin-top: 30px;" class="row">


                <?php $i = 0;
                foreach ($get_kategori as $key => $value) { ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= $value['kategori']; ?> (Lunas)</span>
                                <span class="info-box-number"><?= $total_lunas[$i++]; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                <?php }; ?>

                <?php $i = 0;
                foreach ($get_kategori as $key => $value) { ?>
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= $value['kategori']; ?> (Belum)</span>
                                <span class="info-box-number"><?= $total_belum[$i++]; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                <?php }; ?>
                <!-- /.col -->

                <!-- /.col -->
            </div>

        </div>
    </div>
</div>