<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">


            <div class="content-header">
                <div class="container">


                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <?php foreach ($get_nama as $key => $value) {; ?>
                                <h1 class="m-0"> <?= $tittle; ?> (<?= $value['kategori']; ?>) <small>sontua</small></h1>
                            <?php }; ?>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Kasir/pembeli/' . $id); ?>">List Pembeli</a></li>
                                <li class="breadcrumb-item active">Pembayaran</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div align="center">
                <div class="card col-md-8">
                    <div class="card-header">
                        <div align="left">
                            <?php if ($orderan != null) { ?>
                                <h3 class="card-tittle">Pesanan : <?= $orderan[0]['nama_pembeli']; ?></h3>
                            <?php }; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div align="left">
                            <div class="row">
                                <?php if (!$orderan) {  ?>
                                    <div class="col-md-12">
                                        <div align="center">
                                            <h5>Belum Ada Pesanan, Silahkan pesan dahulu</h5>
                                            <a href="<?= base_url('Kasir/list/' . $id . '/' . $id_pembeli); ?>" class="btn btn-warning">List Product</a>
                                        </div>

                                    </div>
                                <?php } else { ?>
                                    <?php foreach ($orderan as $key => $value) { ?>
                                        <div class="col-md-12">
                                            <div class="card card-outline card-info">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for=""><?= $value['nama_product']; ?></label>
                                                            <br>
                                                            <img src="<?= base_url() ?>/img/<?= $value['img_product']; ?>" width="120" height="70" style="border-radius: 10px; border-color: black; border-style: inset;" alt="">
                                                        </div>
                                                        <div class="col-md-4 form-group">
                                                            <label for="">Jumlah Pesanan</label>
                                                            <input class="form-control" readonly value="x<?= $value['jumlah']; ?>" style="width: 50px;">
                                                        </div>

                                                        <div class="col-md-4 form-group">
                                                            <label for="">Total harga</label>
                                                            <input class="form-control" readonly value="Rp. <?= format_rupiah($value['jumlah'] * (int)$value['harga_product']); ?>" style="width: 130px;">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php }; ?>
                                    <?php if ($orderan[0]['pembayaran'] == 1) { ?>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div style="margin-top: 30px;" class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <a href="<?= base_url('Kasir/list/' . $id . '/' . $id_pembeli); ?>" class="btn btn-warning">Tambah</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <form action="<?= base_url('Kasir/bayar/' . $id . '/' . $id_pembeli); ?>" method="post">
                                                                <input type="hidden" name="pembayaran" value="2">
                                                                <button type="submit" class="btn btn-danger konfirmF" name="pak" value="2">Bayar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="">Total Semua</label>
                                                    <input type="text" name="" id="" class="form-control" readonly value="Rp. <?= format_rupiah($total_harga); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div style="margin-top: 30px;" class="col-md-8">
                                                    <h3><span class="badge badge-success">Sudah Di bayar</span></h3>
                                                </div>

                                                <div class="col-md-4 form-group">
                                                    <label for="">Total Semua</label>
                                                    <input type="text" name="" id="" class="form-control" readonly value="Rp. <?= format_rupiah($total_harga); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    <?php }; ?>
                                <?php }; ?>

                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</div>