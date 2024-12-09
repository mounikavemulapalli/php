<?php
session_start();
if ($_SESSION["login"] && $_SESSION["users"]["role_ad"] == "personel"){ ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danışman | ÇÖMÜ STAJ TAKİP</title>

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
                      <h5 class="modal-title" id="exampleModalLabel">Log out</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                  Are you sure you want to log out ?
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                      <a href="../cikis.php" type="button" class="btn btn-danger">exit</a>
                  </div>
              </div>
          </div>
      </div>

    <!-- Main Sidebar Container -->
   <?php include "../templates/personel-sidebar.php"?>

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
                <li class="breadcrumb-item"><a href="#">Home Page</a></li>
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
                $query= $db->prepare("SELECT * FROM users WHERE rol_id=:kid");
                $query->execute([
                    "kid"=>4
                ]);
                $ogr_sayi = $query->rowCount();
                ?>
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $ogr_sayi  ?></h3>
                            <p>Number of Registered Students</p>
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

                    $query= $db->query("SELECT ad,soyad,email,tel,ogrenci_no,tc,internship_registration.id as kayit_id FROM internship_registration
INNER JOIN Internship_date ON internship_registration.Internship_date_id=Internship_date.id
INNER JOIN users ON internship_registration.ogrenci_id=users.id
INNER JOIN student_details ON internship_registration.ogrenci_id=student_details.ogrenci_id
WHERE NOW() BETWEEN staj_baslangic AND DATE_ADD(staj_baslangic, INTERVAL 7 DAY) AND sigorta_giris_onay=0");
                    $sayi = $query->rowCount();
                ?>
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo $sayi ?></h3>
                  <p>Sigorta Girişi Yapılacaklar</p>
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
              $query= $db->query("SELECT ad,soyad,email,tel,ogrenci_no,tc,internship_registration.id as kayit_id FROM internship_registration
INNER JOIN Internship_date ON internship_registration.Internship_date_id=Internship_date.id
INNER JOIN users ON internship_registration.ogrenci_id=users.id
INNER JOIN student_details ON internship_registration.ogrenci_id=student_details.ogrenci_id
WHERE NOW() BETWEEN DATE_ADD(staj_bitis, INTERVAL -7 DAY) AND staj_bitis AND sigorta_giris_onay=1");

              $danisman_sayi = $query->rowCount();
              ?>
            <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?= $danisman_sayi ?></h3>
                  <p>Insurance Exits to Be Made</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Detailed Information <i class="fas fa-arrow-circle-right"></i>
                </a>
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

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->

      <!-- Default to the left -->
      <strong>Copyright &copy; 2022-2023 <a href="https://www.comu.edu.tr/"></a>.</strong>
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

<?php }else{
header("Location:../index.php");
}
?>