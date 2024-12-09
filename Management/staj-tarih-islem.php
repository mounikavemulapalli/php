<?php
session_start();
require "../config.php";
if ($_SESSION["login"] && $_SESSION["users"]["role_ad"] == "manager"){ ?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yönetici | ÇÖMÜ STAJ TAKİP</title>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">


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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <a href="../cikis.php" type="button" class="btn btn-danger">Çıkış</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Sidebar Container -->
        <?php include "../templates/yonetim-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Staj Dönemi ve Tarih  İşlemleri</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#donem_ekle">
                                    Add / Subtract Period
                                </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekle_danisman">
                                    Add
                                </button>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <div class="modal fade" id="ekle_danisman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Staj Tarihi Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../ajax/Internship_date_kayit.php" method="post" id="personel_kaydet">

                                  <div class="form-group">
                                      <label for="inputAddress">Dönem Yılı:</label>
                                      <?php
                                        $datalar = $db->query("SELECT * FROM terms")->fetchAll();
                                      ?>
                                      <select id="inputState" name="donem_id" class="form-control">
                                      <?php foreach ($datalar as $data): ?>
                                          <option value="<?= $data["id"]; ?>"><?= $data["donem_yil"]; ?></option>
                                    <?php endforeach; ?>
                                      </select>
                                  </div>

                                <div class="form-group">
                                    <label for="inputAddress">Staj Yapılacak Haftalık Gün Sayısı:</label>
                                    <select id="inputState" name="gun" class="form-control">
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>


                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Staj Giriş Tarihi:</label>
                                    <input type="date" name="staj_giris" class="form-control" id="inputEmail4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Staj Bitiş Tarihi:</label>
                                    <input type="date" name="staj_bitis" class="form-control" id="inputPassword4">
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="kaydet">Save</button>
                        </div>
                    </div>
                </div>
            </div>


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
                                                    <th>period</th>
                                                    <th>No of Weekly Internship dates</th>
                                                    <th>Internship Entry Date</th>
                                                    <th>Internship End date</th>
                                                    <th>Transactions</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query=$db->query("SELECT Internship_date.id,staj_bitis,staj_baslangic,haftalik_gun_sayi,donem_yil FROM Internship_date INNER JOIN terms ON Internship_date.donem_id=terms.id;
");
                                            $Internship_dateler = $query->fetchAll(PDO::FETCH_ASSOC);
                                            ?>

                                            <?php foreach ($Internship_dateler as $Internship_date): ?>
                                                <tr>
                                                    <td><?php echo $Internship_date["id"]; ?></td>
                                                    <td><?php echo $Internship_date["donem_yil"]; ?></td>
                                                    <td><?php echo $Internship_date["haftalik_gun_sayi"];?></td>
                                                    <td><?php echo $Internship_date["staj_baslangic"];?></td>
                                                    <td><?php echo $Internship_date["staj_bitis"];?></td>
                                                    <td>
                                                        <a class="btn btn-danger" href="<?php echo "../ajax/Internship_date_sil.php?id=".$Internship_date["id"]; ?>">Sil</a>
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
        <div class="modal fade" id="donem_ekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Term Transactions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../ajax/donem_kayit.php" method="post" id="donem_form">

                            <div class="form-group">
                                <label for="inputPassword4">Add New Term</label>
                                <input type="text" name="donem_tarih" class="form-control" id="datepicker">
                            </div>

                        </form>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Term Year</th>
                                <th scope="col">Transaction:</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $terms=$db->query("SELECT * FROM terms");
                            ?>
                            <?php foreach ($terms as $donem): ?>
                            <tr>
                                <td><?=  $donem["donem_yil"]; ?></td>
                                <td>
                                    <a href="<?php echo "../ajax/donem_sil.php?id=".$donem["id"]; ?>" class="btn btn-danger">Sil</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="kaydet_donem" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->

            <!-- Default to the left -->
            <strong>Copyright &copy; 2022-2023 <a href="https://www.comu.edu.tr/">Çanakkale 18 Mart
                    Üniversitesi</a>.</strong>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

    <script>

        $(document).ready(function () {
            var table = $('#example1').DataTable({
                responsive: true,
                lengthChange: false,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json"
                },
                columnDefs: [
                    {targets:[0],visible:false},
                    {targets:[4],searchable:false}
                ],
                autoWidth: false,
                buttons: [{
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },   {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },  {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, "colvis"],

                initComplete: function () {
                    setTimeout(function () {
                        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    }, 10);
                }
            });
        });

        $("#kaydet").click(function () {
            $("#personel_kaydet").submit();
        });
        $("#kaydet_donem").click(function () {
            $("#donem_form").submit();
        });



        $(document).ready(function(){
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose:true
            });
        })

    </script>


</body>

</html>

<?php }else{
    header("Location:../index.php");
}
?>