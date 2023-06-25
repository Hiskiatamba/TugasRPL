<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('template') ?>/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url('') ?>" class="h1"><b>Toko</b> Hiskia</a>
                <hr>
                <p class="h3"><b>Login</b> Admin</p>
            </div>
            <div class="card-body">
                <?= form_open_multipart('Admin/login', ['class' => 'formlogin']) ?> <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan Username" id="username_login"
                        name="username_login">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Masukan Password" id="password_login"
                        name="password_login">

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <?= form_close() ?>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('template/plugins') ?>/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('template/plugins') ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('template') ?>/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('template/plugins') ?>/sweetalert2/sweetalert2.min.js"></script>

    <script>
    <?php if($this->session->flashdata('error')){ ?>
    var isi = <?php echo json_encode($this->session->flashdata('error')) ?>;
    Swal.fire({
        icon: 'error',
        title: isi
    })
    <?php } ?>

    <?php if($this->session->flashdata('sukses')){ ?>
    var isi = <?php echo json_encode($this->session->flashdata('sukses')) ?>;
    Swal.fire({
        icon: 'success',
        title: isi
    })
    <?php } ?>

    <?php if(form_error('username_login')){ ?>
    var isiusername = <?php echo json_encode(form_error('username_login')) ?>;
    Swal.fire({
        icon: 'warning',
        title: isiusername
    })
    <?php } ?>

    <?php if(form_error('password_login')){ ?>
    var isipassword = <?php echo json_encode(form_error('password_login')) ?>;
    Swal.fire({
        icon: 'warning',
        title: isipassword
    })
    <?php } ?>

    <?php if(form_error('password_login') && form_error('username_login')){ ?>
    var isipassword = <?php echo json_encode(form_error('password_login') && form_error('username_login')) ?>;
    Swal.fire({
        icon: 'warning',
        title: 'Masukan Username Dan Passoword'
    })
    <?php } ?>
    </script>


</body>

</html>