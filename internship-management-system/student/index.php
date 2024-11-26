<?php
session_start();
if ($_SESSION["login"] && $_SESSION["kullanici"]["role_ad"] == "student"){ ?>

    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student | ÇÖMÜ Internship Tracking</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <script src="https://kit.fontawesome.com/1f952dc3e7.js" crossorigin="anonymous"></script>
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
                        <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <a href="../cikis.php" type="button" class="btn btn-danger">Log Out</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sidebar Container -->
        <?php include "../templates/student-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Create Application Registration</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <?php
                         require "../config.php";
                        $query = $db->prepare ("SELECT * FROM internship_registration WHERE student_id=:id");
                        $query->execute([ 
                                "id" => $_SESSION["kullanici"]["id"],
                        ]);

                        $data = $query->fetch();

                        $registration_count = $query->rowCount();
                    ?>

                    <?php if ($registration_count): ?>
                        <div class="alert alert-danger" role="alert">
                            Internship registration can only be done once. For editing, please use the application status page!
                        </div>

                    <?php else: ?>
                        <form class="row g-3 w-75" action="../ajax/internship_application_register.php" method="post">
                            <?php
                            require "../config.php";

                            $query = $db->query("SELECT * FROM terms");
                            $terms = $query->fetchAll();

                            $query = $db->query("SELECT * FROM social_security");
                            $socials = $query->fetchAll();
                            ?>

                            <input type="hidden" name="id" value="<?= $_SESSION["kullanici"]["id"] ?>">

                            <div class="col-md-6 mb-3">
                                <label for="inputEmail4" class="form-label">National ID Number</label>
                                <input type="number" name="tc" class="form-control" id="inputEmail4" placeholder="xxxxxxxxxxx">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="inputPassword4" class="form-label">Phone Number</label>
                                <input type="number" name="tel" class="form-control" id="inputPassword4" placeholder="(5xx)-(xxx)-(xx)-(xx)">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="inputPassword4" class="form-label">Academic Year</label>
                                <select id="ogr_yil" class="form-select form-control">
                                    <option value="err">Select Academic Year</option>
                                    <?php foreach ($terms as $term): ?>
                                        <option value="<?= $term["id"] ?>"><?= $term["term_year"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="hft_saat" class="form-label">Weekly Working Days</label>
                                <select  id="hft_saat"  class="form-select form-control">
                                    <option value="err">Please select days</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="inputPassword4" class="form-label">Internship Start Date</label>
                                <select  id="baslangic" name="internship_date" class="form-select form-control">
                                    <option value="err">Select Start Date</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="inputPassword4" class="form-label">Internship End Date</label>
                                <select disabled id="bitis" class="form-select form-control">
                                    <option value="err">End Date</option>
                                </select>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="inputState" class="form-label d-block">Social Security</label>
                                <select id="inputState" name="insurance" class="form-select form-control">
                                    <?php foreach ($socials as $social): ?>
                                        <option value="<?= $social["id"] ?>"><?= $social["name"]?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Residential Address</label>
                                <textarea class="form-control" name="address" id="" rows="6" placeholder="Enter your residential address..."></textarea>
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Institution Name</label>
                                <input type="text" class="form-control" name="institution_name" placeholder="Institution name">
                            </div>

                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Institution Address</label>
                                <input type="text" class="form-control" name="institution_address" placeholder="Institution address">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Service Area</label>
                                <input type="text" class="form-control" name="service_area" placeholder="Service area">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="institution_phone" placeholder="(5xx)-(xxx)-(xx)-(xx)">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress" class="form-label">Fax Number</label>
                                <input type="text" class="form-control" name="institution_fax" placeholder="(xxx)-(xxx)-(xx)-(xx)">
                            </div>
                            <div class="col-6">
                                <label for="inputAddress" class="form-label">Email Address</label>
                                <input type="text" class="form-control" name="institution_email" placeholder="Institution's email address">
                            </div>

                            <div class="col-6">
                                <label for="inputAddress" class="form-label">Website Address</label>
                                <input type="text" class="form-control" name="institution_website" placeholder="www.xxxx.com">
                            </div>

                            <div class="col-12 my-4">
                                <button type="submit" class="btn btn-success">Complete Application</button>
                            </div>

                        </form>
                    <?php endif; ?>


                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->

            <!-- Default to the left -->
            <strong>Copyright &copy; 2022-2023 <a href="https://www.comu.edu.tr/">Çanakkale 18 Mart University</a>.</strong>
            All Rights Reserved.
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

    <script>
        $("#hft_saat").change(function () {
            let saat = $(this).val();
            let yil = $("#ogr_yil").val();
            $.ajax({
                type : 'POST',
                url : '../ajax/form_data.php',
                data:{
                    datas:{
                        weekly_hours:saat,
                        year:yil
                    }
                },
                success:function(data) {
                    $("#baslangic").html(data);
                }
            })
        });

        $("#baslangic").change(function () {
            let id = $("#baslangic").val();
            $.ajax({
                type : 'POST',
                url : '../ajax/form_data.php',
                data:{
                    internship_date_id:id
                },
                success:function(data) {
                    $("#bitis").html(data);
                }
            })
        })
    </script>
    </body>

    </html>

<?php }else{
    header("Location:../index.php");
}
?>
