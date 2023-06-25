<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('template/plugins') ?>/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/jqvmap/jqvmap.min.css">
    <!-- Theme style -->

    <link rel="stylesheet" href="<?= base_url('template/dist') ?>/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url('template/plugins') ?>/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('template/plugins') ?>/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('template/dist') ?>/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('Admin/index') ?>" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url('Admin/index') ?>" class="brand-link">
                <img src="<?= base_url('template/dist') ?>/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Dashboard Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('template/dist') ?>/img/avatar5.png" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('Admin/index') ?>" class="d-block"><?= $admin['nama_admin'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="<?= base_url('Admin/index') ?>" class="nav-link ">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/data_barang') ?>" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-box"></i>
                                <p>
                                    Data Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/data_kategori') ?>" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-clipboard-list"></i>
                                <p>
                                    Data Kategori
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Transaksi</li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/data_barang_masuk') ?>" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-dolly"></i>
                                <p>
                                    Barang Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/data_barang_keluar') ?>" class="nav-link active">
                                <i class="nav-icon fas fa-solid fa-dolly fa-flip-horizontal"></i>
                                <p>
                                    Barang Keluar
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Logout</li>
                        <li class="nav-item">
                            <a href="<?= base_url('Admin/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-user"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Barang Keluar</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('Admin/index') ?>">Home</a>
                                <li class="breadcrumb-item active">Data Barang Keluar</li>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <button class="btn btn-primary" id="tomboltambahbarangkeluar"><i
                                            class="fas fa-plus"></i>
                                        Tambah
                                        Data</button>
                                    <div class="viewmodal" style="display:none"></div>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="databarangkeluar" class="table table-bordered table-hover"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Kategori</th>
                                                <th>Jumlah Barang Masuk</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Nama Kategori</th>
                                                <th>Jumlah Barang Masuk</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved. CRUD Creat By : Rio Miftahul Huda LP3I Cikarang
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url('template/plugins') ?>/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('template/plugins') ?>/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src="<?= base_url('template/plugins') ?>/bootstrap/js/bootstrap.bundle.min.js">
    </script>

    <script src="<?= base_url('template/plugins') ?>/chart.js/Chart.min.js"></script>

    <script src="<?= base_url('template/plugins') ?>/sparklines/sparkline.js"></script>

    <script src="<?= base_url('template/plugins') ?>/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url('template/plugins') ?>/jqvmap/maps/jquery.vmap.usa.js"></script>

    <script src="<?= base_url('template/plugins') ?>/jquery-knob/jquery.knob.min.js"></script>

    <script src="<?= base_url('template/plugins') ?>/moment/moment.min.js"></script>
    <script src="<?= base_url('template/plugins') ?>/daterangepicker/daterangepicker.js">
    </script>

    <script src="<?= base_url('template/plugins') ?>/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>

    <script src="<?= base_url('template/plugins') ?>/summernote/summernote-bs4.min.js"></script>

    <script src="<?= base_url('template/plugins') ?>/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
    </script>

    <script src="<?= base_url('template/dist') ?>/js/adminlte.js?v=3.2.0"></script>

    <script src="<?= base_url('template/dist') ?>/js/demo.js"></script>

    <script src="<?= base_url('template/dist') ?>/js/pages/dashboard.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('template/plugins') ?>/datatables/jquery.dataTables.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-buttons/js/dataTables.buttons.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-buttons/js/buttons.bootstrap4.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/jszip/jszip.min.js"></script>
    <script src="<?= base_url('template/plugins') ?>/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url('template/plugins') ?>/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url('template/plugins') ?>/datatables-buttons/js/buttons.html5.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-buttons/js/buttons.print.min.js">
    </script>
    <script src="<?= base_url('template/plugins') ?>/datatables-buttons/js/buttons.colVis.min.js">
    </script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('template/plugins') ?>/sweetalert2/sweetalert2.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('template/plugins') ?>/select2/js/select2.full.min.js"></script>

    <script>
    function tampildatabarangkeluar() {
        table = $('#databarangkeluar').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= site_url('Barangkeluar/ambildata') ?>",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0],
                "orderable": false,
                "width": 5
            }],
        });
    }

    $(document).ready(function() {
        tampildatabarangkeluar();
        $('#tomboltambahbarangkeluar').click(function() {
            $.ajax({
                url: '<?= base_url('Barangkeluar/formtambah') ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#modaltambah').on('shown.bs.modal', function(e) {
                            $('#kode_barang').focus();
                        })
                        $('#modaltambah').modal('show');
                    }
                }
            });
        });
    });

    function edit(kode_barang) {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Barang/formedit') ?>",
            data: {
                kode_barang: kode_barang
            },
            dataType: 'json',
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').on('shown.bs.modal', function(e) {
                        $('#nama_barang').focus();
                    })
                    $('#modaledit').modal('show');
                }
            }
        });
    };

    function hapus(id_bk) {
        Swal.fire({
            title: 'Hapus',
            text: `Apakah Kamu Yakin Ingin Menghapus Data Ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('Barangkeluar/hapusdatabarangkeluar') ?>',
                    data: {
                        id_bk: id_bk
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Konfirmasi',
                                text: response.sukses
                            })
                            tampildatabarangkeluar();
                        }
                    }
                });
            }
        })
    };
    </script>
</body>

</html>