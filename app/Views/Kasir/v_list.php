<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">


                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <?php foreach ($get_nama as $key => $value) {; ?>
                                <h1 class="m-0"> <?= $tittle; ?> <?= $value['kategori']; ?> <small>SWALOW</small></h1>
                            <?php }; ?>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">List</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>



            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($id == 1) { ?>
                                <ul class="nav nav-pills">

                                    <li class="nav-item"><a class="nav-link <?= $cari != 1 && $cari != 2 ? 'active' : ''; ?>" href="<?= base_url('Kasir/list/' . $id); ?>">Semua</a></li>

                                    <li class="nav-item">
                                        <form action="<?= base_url('Kasir/list/' . $id); ?>" method="get">
                                            <button type="submit" name="cari" class="btn btn-link nav-link <?= $cari == 1 ? 'active' : ''; ?>" value="1">Makanan</button>
                                        </form>
                                    </li>
                                    <li class="nav-item">
                                        <form action="<?= base_url('Kasir/list/' . $id); ?>" method="get">
                                            <button type="submit" name="cari" class="btn btn-link nav-link <?= $cari == 2 ? 'active' : ''; ?>" value="2">Minuman</button>
                                        </form>
                                    </li>

                                </ul>
                            <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?= base_url('Kasir/list/' . $id); ?>" method="get">
                                        <div class="input-group">
                                            <input type="search" name="cari" class="form-control form-control-lg" placeholder="Type your keywords here">
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

                    <div class="card-body">
                        <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom: 20px;">
                                <button class="btn btn-lg btn-outline-success" type="button" data-toggle="modal" data-target="#modalCart">Lihat Pesanan ( <?= count($pesanan); ?> )</button>
                            </div>
                            <?php foreach ($product as $key => $value) { ?>
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-dark d-flex flex-fill">
                                        <div class="card-header bg-secondary border-bottom-0">
                                            <b> <?= $value['nama_product']; ?></b>
                                        </div>

                                        <div class="card-body pt-0">

                                            <img style="margin-top: 20px; border-radius:10px;" src="<?= base_url() ?>/img/<?= $value['img_product']; ?>" alt="user-avatar" width="100%" height="150">

                                        </div>
                                        <div class="card-footer bg-secondary">
                                            <div class="row">
                                                <div class="col-6 text-left">
                                                    <h5 class="text-light">Rp. <?= format_rupiah($value['harga_product']); ?></h5>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="col-md-12">
                                                        <form action="<?= base_url('/Kasir/pesan/' . $value['id_product']); ?>" method="post">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input type="number" min="1" class="form-control" name="jumlah" value="1">
                                                                    <input type="hidden" name="id_kategori" value="<?= $value['id_kategori']; ?>">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <button type="submit" class="btn btn btn-info konfirmF">
                                                                        Pesan
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }; ?>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div style="float: right;">
                            <?= $pager->links('peoples', 'peoples_pagination'); ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCart">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">list pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php if (!$items) { ?>
                        <b>Anda Belum Memesan</b>
                    <?php } else { ?>
                        <?php foreach ($items as $key => $value) { ?>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?= base_url() ?>/img/<?= $value['photo']; ?>" width="100%" height="100%" alt="" style="border-radius: 5px;">
                                    </div>
                                    <div class="col-md-8">
                                        <span class="text-muted"><?= $value['name']; ?></span>
                                        <hr>
                                        <form action="<?= base_url('Kasir/update/' . $id); ?>" method="post">
                                            <div class="col-md-12">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <input type="hidden" name="id_product" value="<?= $value['id']; ?>">
                                                        <input name="jumlah" min="1" class="form-control" type="number" value="<?= $value['quantity']; ?>">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <button type="submit" class="btn btn-warning konfirmF">
                                                            Edit
                                                        </button>
                                                        <a href="<?= base_url('Kasir/remove/' . $value['id']); ?>" class="btn btn-danger konfirm">
                                                            Hapus
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <hr>
                                        <span>Rp. <?= format_rupiah($value['price'] * $value['quantity']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php }; ?>
                        <span class="text-muted" style="float:right;">Total Semua : Rp. <?= $total; ?></span>
                    <?php }; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>

    </div>
</div>