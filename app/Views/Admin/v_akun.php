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
                                <li class="breadcrumb-item active">List Akun</li>
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

                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Akun <i class="fas fa-plus"></i></button>


                                </div>
                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Nama User</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Hak Akses</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1;
                                            foreach ($akun as $key => $value) { ?>
                                                <td><?= $no++; ?></td>
                                                <td><?= $value['nama_user']; ?></td>
                                                <td><?= $value['username']; ?></td>
                                                <td><?= $value['password']; ?></td>
                                                <td><?= $value['hak_akses'] == 2 ? 'Mitra' : 'Kasir'; ?></td>
                                                <td align="center">
                                                    <button type="button" data-toggle="modal" data-target="#modalEdit<?= $value['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                                    <a href="<?= base_url(); ?>/Admin/hapus_user/<?= $value['id']; ?>" class="btn btn-danger btn-sm konfirm"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title">Tambah akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?= form_open_multipart('Admin/tambah_User') ?>


                    <div class="form-group col-md-12">
                        <label for="nama_user">Nama User</label>
                        <input type="text" name="nama_user" id="nama_user" class="form-control" required>

                    </div>

                    <div class="form-group col-md-12">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>

                    </div>
                    <div class="form-group col-md-12">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="hak_akses">Hak Akses</label>
                        <select name="hak_akses" id="hak_akses" class="form-control">
                            <option value="">--PILIH--</option>
                            <option value="2">Mitra</option>
                            <option value="3">Kasir</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="id_kasir">Kasir</label>
                        <select name="id_kasir" id="id_kasir" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php foreach ($get_kasir as $key => $value) { ?>
                                <option value="<?= $value['id_kasir']; ?>"><?= $value['nama']; ?></option>
                            <?php }; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="id_mitra">Mitra</label>
                        <select name="id_mitra" id="id_mitra" class="form-control">
                            <option value="">--PILIH--</option>
                            <?php foreach ($get_mitra as $key => $value) { ?>
                                <option value="<?= $value['id_mitra']; ?>"><?= $value['nama']; ?></option>
                            <?php }; ?>
                        </select>
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
foreach ($akun as $key => $value) : $no++; ?>
    <div class="modal fade" id="modalEdit<?= $value['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Admin/edit_user/' . $value['id']) ?>
                        <div class="form-group col-md-12">
                            <label for="nama_user">Nama User</label>
                            <input type="text" name="nama_user" id="nama_user" class="form-control" value="<?= $value['nama_user']; ?>" required>

                        </div>

                        <div class="form-group col-md-12">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $value['username']; ?>" required>

                        </div>
                        <div class="form-group col-md-12">
                            <label for="password">Password</label>
                            <input type="text" name="password" id="password" class="form-control" value="<?= $value['password']; ?>" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="hak_akses">Hak Akses</label>
                            <select name="hak_akses" id="hak_akses" class="form-control">
                                <option value="<?= $value['nama_user']; ?>"><?= $value['hak_akses'] == 2 ? 'Mitra' : 'Kasir'; ?></option>
                                <option value="2">Mitra</option>
                                <option value="3">Kasir</option>
                            </select>
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