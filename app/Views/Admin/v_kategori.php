<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <?= $tittle; ?> <small>SWALOW</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Kategori</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-12">
                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Kategori <i class="fas fa-plus"></i></button>


                                </div>
                                <br>
                                <?php if (!empty(session()->getFlashdata('sukses'))) { ?>
                                    <div align="center" class="alert alert-success">
                                        <?= session()->getFlashdata('sukses'); ?>
                                    </div>
                                <?php } ?>
                                <br>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1;
                                            foreach ($get_kategori as $key => $value) { ?>
                                                <td style="text-align: center;"><?= $no++; ?></td>
                                                <td><?= $value['kategori']; ?></td>
                                                <td style="text-align: right;">
                                                    <button type="button" data-toggle="modal" data-target="#modalEdit<?= $value['id_kategori']; ?>" class="btn btn-warning btn-sm">Edit Kategori </button>

                                                    <a onclick="return confirm('Yakin....?')" href="<?= base_url(); ?>/Kategori/hapus_kategori/<?= $value['id_kategori']; ?>" class="btn btn-danger btn-sm"> Hapus Kategori</a>

                                                </td>
                                        </tr>
                                    <?php }; ?>
                                    </tbody>

                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
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
                    <?= form_open_multipart('Kategori/tambah_kategori') ?>


                    <div class="form-group col-md-12">
                        <label for="kategori">Kategori</label>
                        <input type="text" name="kategori" id="kategori" class="form-control" required>

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
<?php $no = 0;
foreach ($get_kategori as $key => $value) : $no++; ?>
    <div class="modal fade" id="modalEdit<?= $value['id_kategori']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Kategori/edit_kategori/' . $value['id_kategori']) ?>


                        <div class="form-group col-md-12">
                            <label for="kategori">Kategori</label>

                            <input type="text" name="kategori" id="kategori" class="form-control" required value="<?= $value['kategori']; ?>">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
<?php endforeach; ?>