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
                                <li class="breadcrumb-item active">List Pembeli</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>
            <div class="flash-data2" data-flashdata2="<?= session()->getFlashdata('gagal'); ?>"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <ul class="nav nav-pills">

                                <li class="nav-item"><a class="nav-link <?= $cari2 == null && $tanggal_awal == null && $tanggal_akhir == null && $cari == null ? 'active' : ''; ?>" href="<?= base_url('Kasir/pembeli/' . $id); ?>">Semua</a></li>

                                <li class="nav-item">
                                    <form action="<?= base_url('Kasir/pembeli/' . $id); ?>" method="get">
                                        <?php if ($tanggal_awal != null && $tanggal_akhir != null) { ?>
                                            <input type="hidden" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>">
                                            <input type="hidden" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>">
                                            <button type="submit" name="cari2" class="btn btn-link nav-link <?= $cari2 == 1 ? 'active' : ''; ?>" value="1">Belum Bayar</button>
                                        <?php } else { ?>
                                            <button type="submit" name="cari2" class="btn btn-link nav-link <?= $cari2 == 1 ? 'active' : ''; ?>" value="1">Belum Bayar</button>
                                        <?php } ?>

                                    </form>
                                </li>
                                <li class="nav-item">
                                    <form action="<?= base_url('Kasir/pembeli/' . $id); ?>" method="get">
                                        <?php if ($tanggal_awal != null && $tanggal_akhir != null) { ?>
                                            <input type="hidden" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>">
                                            <input type="hidden" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>">
                                            <button type="submit" name="cari2" class="btn btn-link nav-link <?= $cari2 == 2 ? 'active' : ''; ?>" value="2">Lunas</button>
                                        <?php } else { ?>
                                            <button type="submit" name="cari2" class="btn btn-link nav-link <?= $cari2 == 2 ? 'active' : ''; ?>" value="2">Lunas</button>
                                        <?php } ?>

                                    </form>
                                </li>

                            </ul>

                        </div>
                        <div style="margin-top: 10px;" class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="<?= base_url('Kasir/pembeli/' . $id); ?>" method="get">
                                        <div class="input-group">
                                            <?php if ($tanggal_awal != null && $tanggal_akhir != null) { ?>
                                                <input type="hidden" name="tanggal_awal" id="" value="<?= $tanggal_awal; ?>">
                                                <input type="hidden" name="tanggal_akhir" id="" value="<?= $tanggal_akhir; ?>">
                                                <?php if ($cari2 !== null) { ?>
                                                    <input type="hidden" name="cari2" id="" value="<?= $cari2; ?>">
                                                <?php }; ?>
                                                <input type="search" name="cari" class="form-control form-control-lg" placeholder="Type your keywords here">
                                            <?php } else { ?>
                                                <?php if ($cari2 !== null) { ?>
                                                    <input type="hidden" name="cari2" id="" value="<?= $cari2; ?>">
                                                <?php }; ?>
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
                    <div class="col-md-12">
                        <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Pembeli <i class="fas fa-plus"></i></button>


                    </div>
                    <?php if ($cari == null) { ?>
                        <form action="" method="get">
                            <div style="margin-top: 20px;" class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-5 form-group">
                                                <label for="">Tanggal awal</label>
                                                <input type="date" name="tanggal_awal" id="" class="form-control" value="<?= $tanggal_awal; ?>" required>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="">Tanggal Akhir</label>
                                                <input type="date" name="tanggal_akhir" id="" class="form-control" value="<?= $tanggal_akhir; ?>" required>
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
                                                <input type="date" name="tanggal_awal" id="" class="form-control" value="<?= $tanggal_awal; ?>" required>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label for="">Tanggal Akhir</label>
                                                <input type="date" name="tanggal_akhir" id="" class="form-control" value="<?= $tanggal_akhir; ?>" required>
                                            </div>
                                            <input type="hidden" name="cari" value="<?= $cari; ?>">
                                            <input type="hidden" name="cari" value="<?= $cari2; ?>">
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
                                    <th scope="col">Nama</th>
                                    <th scope="col">Pembayaran</th>
                                    <th scope="col">Tanggal Order</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    foreach ($list_pembeli as $key => $pembeli) { ?>

                                        <td><?= $nomor++; ?></td>
                                        <td><?= $pembeli['nama_pembeli']; ?></td>
                                        <td><a href="<?= base_url('Kasir/pembayaran/' . $id . '/' . $pembeli['id_pembeli']); ?>" class="btn btn-<?= $pembeli['pembayaran'] == 1 ? 'info' : 'success'; ?>"><?= $pembeli['pembayaran'] == 1 ? 'Belum' : 'Lunas'; ?></a></td>
                                        <td><?= format_indo($pembeli['created_at']); ?></td>
                                        <td>
                                            <a href="<?= base_url('Kasir/hapus_pembeli/' . $id . '/' . $pembeli['id_pembeli']); ?>" class="btn btn-danger konfirm"><i class="fas fa-trash"></i>
                                </tr>
                            <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div style="float: left;">
                        <span>Total Pembeli : <?= $total_pembeli; ?></span>
                    </div>
                    <div style="float: right;">
                        <?= $pager->links('peoples', 'peoples_pagination'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?= form_open_multipart('Kasir/tambah_pembeli/' . $id) ?>


                    <div class="form-group col-md-12">
                        <label for="nama_pembeli">Nama Pembeli</label>
                        <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>