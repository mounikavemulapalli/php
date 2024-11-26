<?php
session_start();
require "../config.php";
if ($_SESSION["login"] && $_SESSION["kullanici"]["role_ad"] == "advisor"){ ?>


    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Advisor | ÇÖMÜ Internship Follow-up</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
        <?php include "../templates/advisor-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Internship Approval Process</h1>
                        </div><!-- /.col -->
<!--                        <div class="col-sm-6">-->
<!--                            <ol class="breadcrumb float-sm-right">-->
<!--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_advisor">-->
<!--                                    Add-->
<!--                                </button>-->
<!--                            </ol>-->
<!--                        </div>/.col -->
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
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Full Name</th>
                                                <th>Student Number</th>
                                                <th>Student Email</th>
                                                <th>Phone Number</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            $query=$db->prepare("SELECT staj_kayit.id as kayit_id,ad,soyad,ogrenci_no,tel,email,kullanicilar.id as k_id  FROM staj_kayit
INNER JOIN ogrenci_detay ON staj_kayit.ogrenci_id=ogrenci_detay.ogrenci_id
INNER JOIN kullanicilar ON staj_kayit.ogrenci_id=kullanicilar.id
WHERE ogrenci_detay.danisman_id_fk=:danisman_id AND staj_kayit.danisman_onay=0");
                                            $query->execute([
                                                    "danisman_id"=>$_SESSION["kullanici"]["id"]
                                            ]);
                                            $internships = $query->fetchAll(PDO::FETCH_ASSOC);
                                            //print_r($internships);
                                            ?>

                                            <?php foreach ($internships as $internship): ?>
                                                <tr>
                                                    <td><?php echo $internship["kayit_id"]; ?></td>
                                                    <td><?php echo $internship["ad"]." ".$internship["soyad"]; ?></td>
                                                    <td><?php echo $internship["ogrenci_no"] ?></td>
                                                    <td><?php echo $internship["email"] ?></td>
                                                    <td><?php echo $internship["tel"]; ?></td>
                                                    <td>
                                                        <a class="btn btn-info" href="<?php echo "../student/pdf/index.php?id=".$internship["k_id"]; ?>">Show Details</a>
                                                        <a class="btn btn-success" href="<?php echo "../ajax/internship_approval.php?id=".$internship["kayit_id"]; ?>">Approve</a>
                                                    </td>
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
                                    <label for="inputEmail4">First Name:</label>
                                    <input type="text" name="ad" class="form-control" id="inputEmail4" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Last Name:</label>
                                    <input type="text" name="soyad" class="form-control" id="inputPassword4" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Email Address:</label>
                                <input type="email" name="email" class="form-control" id="inputAddress" placeholder="xxxxx@comu.edu.tr">
                            </div>



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Department:</label>
                                    <select id="inputCity" name="bolum" class="form-control">
                                        <?php foreach ($departments as $department): ?>
                                            <option value="<?php echo $department["id"] ?>"><?php echo $department["bolum_ad"]; ?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputState">Title:</label>
                                    <input type="text" name="unvan" class="form-control" id="inputState" placeholder="Professor/Assistant Professor">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>ÇOMÜ Internships Follow-up System</strong>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>

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

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": false,
                "language": {
                    "emptyTable": "No records found"
                }
            });
        });
    </script>

    </body>
    </html>

<?php } else { header("Location:../login.php");}
