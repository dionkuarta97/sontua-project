<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">

            <div class="content-header">
                <div class="container">


                    <div class="row mb-2">
                        <div class="col-sm-6">

                            <h1 class="m-0"> <?= $tittle; ?> <small>sontua</small></h1>

                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Mitra'); ?>">List Mitra</a></li>
                                <li class="breadcrumb-item active">Detail Mitra</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <ul class="nav nav-pills">

                                <li class="nav-item"><a class="nav-link <?= $cari == null && $tanggal_awal == null && $tanggal_akhir == null ? 'active' : ''; ?>" href="<?= base_url('Mitra/detail/' . $id_mitra); ?>">Semua</a></li>




                            </ul>
                        </div>
                        <div style="margin-top: 10px;" class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?= base_url('Mitra/detail/' . $id_mitra); ?>" method="get">
                                        <div class="input-group">
                                            <?php if ($tanggal_awal != null && $tanggal_akhir != null) { ?>
                                                <input type="hidden" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>">
                                                <input type="hidden" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>">
                                                <input type="search" name="cari" class="form-control form-control-lg" placeholder="Type your keywords here">
                                            <?php } else { ?>
                                                <input type="search" name="cari" class="form-control form-control-lg" placeholder="Type your keywords here">
                                            <?php } ?>

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-lg btn-default">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <?php if ($cari == null) { ?>
                        <form action="<?= base_url('Mitra/detail/' . $id_mitra); ?>" method="get">
                            <div style="margin-top: 20px;" class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class=" col-md-5 form-group">
                                                <label for="">Tanggal awal</label>
                                                <input type="date" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>" class="form-control" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="">Tanggal Akhir</label>
                                                <input type="date" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>" class="form-control" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;" class="col-md-1">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } else { ?>
                        <form action="" method="get">
                            <div style="margin-top: 20px;" class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-5 form-group">
                                                <label for="">Tanggal awal</label>
                                                <input type="date" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>" class="form-control" required>
                                            </div>

                                            <div class="col-md-5">
                                                <label for="">Tanggal Akhir</label>
                                                <input type="date" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>" class="form-control" required>
                                            </div>
                                            <input type="hidden" name="cari" value="<?= $cari; ?>">

                                        </div>
                                    </div>
                                    <div style="margin-top: 10px;" class="col-md-1">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php }; ?>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Harga x Jumlah</th>
                                    <th scope="col">Tanggal Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($list_order as $key => $value) { ?>
                                        <td><?= $nomor++; ?></td>
                                        <td><?= $value['nama_product']; ?></td>
                                        <td><?= $value['jumlah']; ?></td>
                                        <td>Rp. <?= format_rupiah($value['harga_product'] * ((100 - $detail_mitra['bagi_hasil']) / 100)); ?></td>
                                        <td>Rp. <?= format_rupiah($value['jumlah'] * ($value['harga_product'] * ((100 - $detail_mitra['bagi_hasil']) / 100))); ?></td>
                                        <td><?= format_indo($value['created_at']); ?></td>
                                </tr>
                            <?php }; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <td>Rp. <?= format_rupiah($total_all) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div style="float: left;">
                        <span><b>Total Order </b> : <?= $count_all; ?> </span>
                    </div>
                    <div style="float: right;">
                        <?= $pager->links('peoples', 'peoples_pagination'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>