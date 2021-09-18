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
                                <div class="col-md-12">

                                    <button type="button" data-toggle="modal" data-target="#modalTambah" class="btn btn-outline-primary">Tambah Product <i class="fas fa-plus"></i></button>


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
                                                <td align="center"><img src="<?= base_url() ?>/img/<?= $value['img_product']; ?>" width="200"></td>
                                                <td><?= $value['nama_productBumnag']; ?></td>
                                                <td>Rp. <?= format_rupiah($value['harga_productBumnag']); ?></td>
                                                <td align="center">
                                                    <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                    <a href="" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php foreach ($get_product as $key => $value) {; ?>
                        <?= form_open_multipart(base_url('ProductBumnag/proses/' . $value['id_kategori'])); ?>
                    <?php }; ?>
                    <div class="card-body col-sm-12">
                        <div class="row">


                            <div class="form-group col-md-12">
                                <label for="nama_productBumnag">Nama Product</label>
                                <input type="text" name="nama_productBumnag" id="nama_productBumnag" class="form-control">

                            </div>


                            <div class="form-group col-md-12">
                                <label for="harga_productBumnag">Harga Product</label>
                                <input type="text" name="harga_productBumnag" id="harga_productBumnag" class="form-control">

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

                    <!-- /.card-body -->
                    <div class=" card-footer">
                        <div class="form-group">
                            <?= form_submit('Send', 'Simpan') ?>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>