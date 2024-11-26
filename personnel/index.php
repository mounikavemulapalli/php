<?php
session_start();
if ($_SESSION["login"] && $_SESSION["kullanici"]["role_ad"] == "staff") { ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Consultant | ÇÖMÜ Internship Tracker</title>

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
                      <a href="../logout.php" type="button" class="btn btn-danger">Logout</a>
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
              <h1 class="m-0">Dashboard</h1>
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
            <div class="row">
                <?php
                require "../config.php";
                $query= $db->prepare("SELECT * FROM users WHERE role_id=:role_id");
                $query->execute([
                    "role_id" => 4
                ]);
                $student_count = $query->rowCount();
                ?>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $student_count ?></h3>
                            <p>Registered Student Count</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Detailed Information <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
          <div class="row">

            <div class="col-lg-3 col-6">
                <?php

                    $query= $db->query("SELECT first_name, last_name, email, phone, student_no, national_id, internship_registration.id AS registration_id FROM internship_registration
INNER JOIN internship_dates ON internship_registration.internship_date_id=internship_dates.id
INNER JOIN users ON internship_registration.student_id=users.id
INNER JOIN student_details ON internship_registration.student_id=student_details.student_id
WHERE NOW() BETWEEN internship_start AND DATE_ADD(internship_start, INTERVAL 7 DAY) AND insurance_entry_approved=0");
                    $entry_count = $query->rowCount();
                ?>
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $entry_count ?></h3>
                  <p>Insurance Entries Pending</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Detailed Information <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
              <?php
              $query= $db->query("SELECT first_name, last_name, email, phone, student_no, national_id, internship_registration.id AS registration_id FROM internship_registration
INNER JOIN internship_dates ON internship_registration.internship_date_id=internship_dates.id
INNER JOIN users ON internship_registration.student_id=users.id
INNER JOIN student_details ON internship_registration.student_id=student_details.student_id
WHERE NOW() BETWEEN DATE_ADD(internship_end, INTERVAL -7 DAY) AND internship_end AND insurance_entry_approved=1");

              $advisor_count = $query->rowCount();
              ?>
            <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $advisor_count ?></h3>
                  <p>Insurance Exit Pending</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Detailed Information <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

          </div>
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
</body>

</html>

<?php } else {
header("Location:../index.php");
}
?>