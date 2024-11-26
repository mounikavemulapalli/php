<?php
session_start();
require "../config.php";
if ($_SESSION["login"] && $_SESSION["user"]["role_name"] == "staff") { ?>

    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Staff | ÇÖMÜ Internship Tracking</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <script src="https://kit.fontawesome.com/1f952dc3e7.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    </head>

    <body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal" data-slide="true" href="#" role="button">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Log Out</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="../logout.php" type="button" class="btn btn-danger">Log Out</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sidebar Container -->
        <?php include "../templates/staff-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Insurance Record Listing</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row"></div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <table id="example1"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>TC</th>
                                                <th>Student No</th>
                                                <th>Phone</th>
                                                <th>Insurance Entry Status</th>
                                                <th>Insurance Exit Status</th>
                                                <th>Internship Start Date</th>
                                                <th>Internship End Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            $query = $db->query("SELECT staj_kayit.id as kayit_id, CONCAT(ad, \" \", soyad) as full_name, tc, ogrenci_no, tel, sigorta_giris_onay, sigorta_cikis_onay,
DATE_FORMAT(staj_baslangic, \"%d-%m-%Y\") as staj_baslangic, DATE_FORMAT(staj_bitis, \"%d-%m-%Y\") as staj_bitis FROM `staj_kayit`
INNER JOIN staj_tarih ON staj_kayit.staj_tarih_id = staj_tarih.id
INNER JOIN ogrenci_detay ON staj_kayit.ogrenci_id = ogrenci_detay.ogrenci_id
INNER JOIN kullanicilar ON kullanicilar.id = staj_kayit.ogrenci_id
");

                                            $staffMembers = $query->fetchAll(PDO::FETCH_ASSOC);

                                            ?>

                                            <?php foreach ($staffMembers as $staff): ?>
                                                <tr>
                                                    <td><?php echo $staff["kayit_id"]; ?></td>
                                                    <td><?php echo $staff["full_name"] ?></td>
                                                    <td><?php echo $staff["tc"] ?></td>
                                                    <td><?php echo $staff["ogrenci_no"] ?></td>
                                                    <td><?php echo $staff["tel"] ?></td>
                                                    <td>
                                                        <?php if ($staff["sigorta_giris_onay"] == 1) { ?>
                                                            <div class="alert-success p-2" role="alert">
                                                                Completed
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="alert-warning p-2 text-white" role="alert">
                                                                Pending
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($staff["sigorta_cikis_onay"] == 1) { ?>
                                                            <div class="alert-success p-2" role="alert">
                                                                Completed
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="alert-warning p-2 text-white" role="alert">
                                                                Pending
                                                            </div>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $staff["staj_baslangic"]; ?></td>
                                                    <td><?php echo $staff["staj_bitis"]; ?></td>

                                                </tr>
                                            <?php endforeach; ?>

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Advisor Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../ajax/advisor_edit.php" method="post" id="advisor_edit">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Name:</label>
                                    <input type="text" name="name" class="form-control" id="inputEmail4" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Surname:</label>
                                    <input type="text" name="surname" class="form-control" id="inputPassword4" placeholder="Surname">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Email Address:</label>
                                <input type="email" name="email" class="form-control" id="inputAddress" placeholder="xxxxx@comu.edu.tr">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Department:</label>
                                    <select class="form-control" name="department" id="department">
                                        <option selected>Choose...</option>
                                        <option value="CS">Computer Engineering</option>
                                        <option value="ME">Mechanical Engineering</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputZip">Title:</label>
                                    <select class="form-control" name="title" id="title">
                                        <option selected>Choose...</option>
                                        <option value="Prof">Professor</option>
                                        <option value="Assoc.Prof">Associate Professor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    </body>
    </html>
<?php } else {
    header("Location: ../login.php");
}
?>
