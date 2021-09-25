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
                        <li class="breadcrumb-item active">Mitra</li>
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
                                <h3 class="card-title">Daftar Mitra</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="col-md-12">

                                    <button data-toggle="modal" data-target="#modalTambah" type="button" class="btn btn-outline-primary">Tambah Mitra <i class="fas fa-plus"></i></button>


                                </div>
                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mitra</th>
                                            <th>Kategori</th>
                                            <th>Bagi Hasil (%)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1;
                                            foreach ($get_mitra as $key => $value) { ?>
                                                <td><?= $no++; ?></td>
                                                <td><?= $value['nama']; ?></td>
                                                <td><?= $value['kategori']; ?></td>
                                                <td><?= $value['bagi_hasil']; ?>%</td>
                                                <td style="text-align: right;"><button type="button" data-toggle="modal" data-target="#modalEdit<?= $value['id_mitra']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                                                    <a href="<?= base_url(); ?>/Mitra/hapus_mitra/<?= $value['id_mitra']; ?>" class="btn btn-danger btn-sm konfirm"><i class="fas fa-trash"></i></a>
                                                    <a href="<?= base_url(); ?>/Mitra/detail/<?= $value['id_mitra']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
                <h5 class="modal-title">Tambah Mitra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?= form_open_multipart('Mitra/tambah_mitra') ?>


                    <div class="form-group col-md-12">
                        <label for="nama">Nama Mitra</label>
                        <input type="text" name="nama" id="nama" class="form-control" required>

                    </div>

                    <div class="form-group col-md-12">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" name="id_kategori" id="id_kategori">
                            <option value="">--PILIH--</option>
                            <?php foreach ($get_kategori as $key => $value) { ?>
                                <option value="<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></option>
                            <?php }; ?>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="bagi_hasil">Bagi Hasil</label>
                        <input type="text" name="bagi_hasil" id="bagi_hasil" class="form-control" required placeholder="ex : 10">

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
foreach ($get_mitra as $key => $value) : $no++; ?>
    <div class="modal fade" id="modalEdit<?= $value['id_mitra']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mitra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('Mitra/edit_mitra/' . $value['id_mitra']) ?>

                        <div class="form-group col-md-12">
                            <label for="nama">Nama Mitra</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $value['nama']; ?>" required>

                        </div>

                        <div class="form-group col-md-12">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                <option value="<?= $value['id_kategori']; ?>"><?= $value['kategori']; ?></option>
                                <?php foreach ($get_kategori as $key => $kategori) { ?>
                                    <option value="<?= $kategori['id_kategori']; ?>"><?= $kategori['kategori']; ?></option>
                                <?php }; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="bagi_hasil">Bagi Hasil</label>
                            <input type="text" name="bagi_hasil" id="bagi_hasil" class="form-control" required value="<?= $value['bagi_hasil']; ?>">

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