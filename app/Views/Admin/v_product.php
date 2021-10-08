<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <?= $tittle; ?> <small>sontua</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Product</li>
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
                                <?php foreach ($get_nama as $key => $value) {; ?>
                                    <h3 class="card-title">Daftar Kategori <?= $value['kategori']; ?></h3>
                                <?php }; ?>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div style="margin-bottom: 10px;" class="col-md-12">

                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Product <i class="fas fa-plus"></i></button>


                                </div>
                                <div class="flash-data" data-flashdata="<?= session()->getFlashdata('sukses'); ?>"></div>

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th>Foto Product</th>
                                            <th>Nama Product</th>
                                            <th>Harga Product</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $no = 1;
                                            foreach ($get_product as $key => $value) { ?>
                                                <td><?= $no++; ?></td>
                                                <td align="center"><img src="<?= base_url() ?>/img/<?= $value['img_product']; ?>" style="border-radius: 10px;" width="150" height="100"></td>
                                                <td><?= $value['nama_product']; ?></td>
                                                <td>Rp. <?= format_rupiah($value['harga_product']); ?></td>
                                                <td align="center">
                                                    <button type="button" data-toggle="modal" data-target="#modalEdit<?= $value['id_product']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>

                                                    <a href="<?= base_url(); ?>/ProductBumnag/hapus_product/<?= $value['id_kategori']; ?>/<?= $value['id_product']; ?>" class="btn btn-danger btn-sm konfirm"><i class="fas fa-trash"></i></a>

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
                <h5 class="modal-title">Tambah Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php foreach ($get_kategori as $key => $value) {; ?>
                        <?= form_open_multipart('ProductBumnag/proses/' . $value['id_kategori']) ?>
                    <?php }; ?>
                    <div class="card-body col-sm-12">
                        <div class="row">


                            <div class="form-group col-md-12">
                                <label for="nama_product">Nama Product</label>
                                <input type="text" name="nama_product" id="nama_product" class="form-control">

                            </div>


                            <div class="form-group col-md-12">
                                <label for="harga_product">Harga Product</label>
                                <input type="text" name="harga_product" id="harga_product" class="form-control">

                            </div>

                            <?php if ($id == 1) {; ?>
                                <div class="form-group col-md-12">
                                    <label for=" jenis_product">Jenis Product</label>
                                    <select class="form-control" name="jenis_product" id="jenis_product">
                                        <option value="">--PILIH--</option>
                                        <option value="1">Makanan</option>
                                        <option value="2">Minuman</option>
                                    </select>
                                </div>
                            <?php }; ?>
                            <div class="col-md-12">
                                <label>Upload Foto</label>
                                <div class="form-group">
                                    <input type="file" name="file_upload" class="form-control" required>
                                </div>
                            </div>


                        </div>
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
foreach ($get_product as $key => $value) : $no++; ?>
    <div class="modal fade" id="modalEdit<?= $value['id_product']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?= form_open_multipart('ProductBumnag/edit_product/' . $value['id_kategori'] . '/' . $value['id_product']) ?>


                        <div class="form-group col-md-12">
                            <label for="nama_product">Nama Product</label>
                            <input type="text" name="nama_product" id="nama_product" class="form-control" value="<?= $value['nama_product']; ?>">

                        </div>


                        <div class="form-group col-md-12">
                            <label for="harga_product">Harga Product</label>
                            <input type="text" name="harga_product" id="harga_product" class="form-control" value="<?= $value['harga_product']; ?>">

                        </div>

                        <?php if ($id == 1) {; ?>
                            <div class="form-group col-md-12">
                                <label for=" jenis_product">Jenis Product</label>
                                <select class="form-control" name="jenis_product" id="jenis_product">
                                    <option value="<?= $value['jenis_product']; ?>"><?= $value['jenis_product'] == 1 ? 'Makanan' : 'Minuman'; ?></option>
                                    <option value="1">Makanan</option>
                                    <option value="2">Minuman</option>
                                </select>
                            </div>
                        <?php }; ?>

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