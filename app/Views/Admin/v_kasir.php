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
                                <li class="breadcrumb-item active">List Kasir</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->

                            <div class="card-body">
                                <div style="margin-bottom: 10px;" class="col-md-12">

                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Kasir <i class="fas fa-plus"></i></button>


                                </div>
                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1;
                                            foreach ($kasir as $key => $value) { ?>
                                                <td><?= $no++; ?></td>
                                                <td><?= $value['nama']; ?></td>
                                                <td align="center">
                                                    <button type="button" data-toggle="modal" data-target="#modalEdit<?= $value['id_kasir']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                                    <a href="<?= base_url(); ?>/Admin/hapus_kasir/<?= $value['id_kasir']; ?>" class="btn btn-danger btn-sm konfirm"><i class="fas fa-trash"></i></a>
                                                    <a href="<?= base_url(); ?>/Admin/detail_kasir/<?= $value['id_kasir']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
                <h5 class="modal-title">Tambah Kasir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?= form_open_multipart('Admin/tambah_kasir') ?>


                    <div class="form-group col-md-12">
                        <label for="nama">Nama Kasir</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>

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
foreach ($kasir as $key => $value) : $no++; ?>
    <div class="modal fade" id="modalEdit<?= $value['id_kasir']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kasir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Admin/edit_kasir/' . $value['id_kasir']) ?>
                        <div class="form-group col-md-12">
                            <label for="nama">Nama Kasir</label>
                            <input type="text" name="nama" id="nama" class="form-control" required value="<?= $value['nama']; ?>">
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