<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div align="center">
                <div class="login-box">
                    <div class="login-logo">
                        <b>Sontua</b> Wisata</a>
                    </div>
                    <!-- /.login-logo -->
                    <div align="left">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <p class="login-box-msg">Silahkan Login</p>

                                <?php

                                $errors = session()->getFlashdata('errors');

                                if (!empty($errors)) { ?>

                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            <?php foreach ($errors as $key => $value) { ?>
                                                <li>
                                                    <?= esc($value) ?>
                                                </li>

                                            <?php } ?>

                                        </ul>

                                    </div>



                                <?php } ?>

                                <?php if (session()->getFlashdata('pesan')) { ?>

                                    <div class="alert alert-warning" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php } ?>

                                <?= form_open('auth/cek_login') ?>
                                <div class="input-group mb-3">
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <select name="level" class="form-control">
                                        <option value="">--Hak Akses--</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Mitra</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="icheck-primary">

                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <?= form_close() ?>

                            </div>
                        </div> <!-- /.login-card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>