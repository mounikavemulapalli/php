<?php
session_start();
if ($_SESSION["login"] && $_SESSION["users"]["role_ad"] == "öğrenci"){ ?>

    <!DOCTYPE html>
    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->
    <html lang="tr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Öğrenci | ÇÖMÜ STAJ TAKİP</title>

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
                        <h5 class="modal-title" id="exampleModalLabel">Çıkış Yap</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Çıkış yapmak istediğinize emin misiniz ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <a href="../cikis.php" type="button" class="btn btn-danger">Çıkış</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sidebar Container -->
        <?php include "../templates/ogrenci-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Staj Başvuru Durumu</h1>
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
                    <table class="table table-bordered">
                        <thead>
                        <tr>

                            <th scope="col">Full Name</th>
                            <th scope="col">manager Onay </th>
                            <th scope="col">Danışman Onay </th>
                            <th scope="col">Oluşturulma Tarihi</th>
                            <th scope="col">Transactions</th>
                        </tr>
                        </thead>
                        <tbody>

                            <?php

                            require "../config.php";

                            $query = $db->prepare("SELECT concat(users.ad,\" \",users.soyad) as ad_soyad,Internship_Registration.mudur_onay,Internship_Registration.danisman_onay,Internship_Registration.create_tarih,Internship_date.id  FROM Internship_Registration
INNER JOIN users ON users.id=Internship_Registration.ogrenci_id
INNER JOIN student_details ON student_details.ogrenci_id=Internship_Registration.ogrenci_id
INNER JOIN Internship_date ON Internship_date.id=Internship_Registration.Internship_date_id
INNER JOIN social_security ON social_security.id=Internship_Registration.sigorta
INNER JOIN terms ON Internship_date.donem_id=terms.id WHERE users.id =:id");
                            $query->execute([
                                    "id"=>$_SESSION["users"]["id"]
                            ]);
                            $kayitlar=$query->fetchAll();

                            ?>

                            <?php foreach ($kayitlar as $kayit): ?>

                            <tr>
                            <th><?= $kayit["ad_soyad"]; ?></th>
                            <td>
                                <?php
                                if ($kayit["mudur_onay"]==0){
                                    echo "<span class=\"text-danger font-weight-bold\">Not Approved</span>";
                                }else{
                                    echo "<span class=\"text-success font-weight-bold\">Confirmed</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($kayit["danisman_onay"]==0){
                                    echo "<span class=\"text-danger font-weight-bold\">Not Approved</span>";
                                }else{
                                    echo "<span class=\"text-success font-weight-bold\">Confirmed</span>";
                                }
                                ?>
                            </td>
                            <td><?= $kayit["create_tarih"]; ?></td>
                            <td>
                                <a class="btn btn-info" href="<?php echo "pdf/index.php?id=".$_SESSION["users"]["id"] ?>" >Dosyayı İndir</a>
                                <a class="btn btn-danger" href="<?php echo "../ajax/Internship_Registration_sil.php?id=".$kayit["id"]?>" >Sil</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
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
            <strong>Copyright &copy; 2022-2023 <a href="https://www.comu.edu.tr/">TEN Network</a>.</strong>
            Tüm
            Hakları Saklıdır.
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