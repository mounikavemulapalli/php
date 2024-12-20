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
        <?php include "../templates/yonetim-sidebar.php"?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Consultant Procedures</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <button type="button" class="btn btn-info mr-3" data-toggle="modal" data-target="#unvan_ekle">
                                    Add / Remove Title
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
                            <h5 class="modal-title" id="exampleModalLabel">Danışman Ekle</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="../ajax/danisman_kayit.php" method="post" id="danisman_kaydet">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Ad:</label>
                                        <input type="text" name="ad" class="form-control" id="inputEmail4" placeholder="Ad">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Soyad:</label>
                                        <input type="text" name="soyad" class="form-control" id="inputPassword4" placeholder="Soyad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">E-Posta Adresi:</label>
                                    <input type="email" name="email" class="form-control" id="inputAddress" placeholder="xxxxx@comu.edu.com.tr">
                                </div>


                                <?php


                                    $query=$db->prepare("SELECT * FROM bolumler");
                                    $query->execute();
                                    $department = $query->fetchAll(PDO::FETCH_ASSOC);


                                    $query=$db->prepare("SELECT * FROM titles");
                                    $query->execute();
                                    $titles = $query->fetchAll(PDO::FETCH_ASSOC);

                                ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputCity">Section:</label>
                                        <select id="inputCity" name="bolum" class="form-control">
                                            <?php foreach ($bolumler as $bolum): ?>
                                                <option value="<?php echo $bolum["id"] ?>"><?php echo $bolum["bolum_ad"]; ?></option>
                                            <?php endforeach;?>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Ünvan:</label>
                                        <select id="inputState" name="unvan" class="form-control">

                                            <?php foreach ($titles as $unvan): ?>
                                                <option value="<?php echo $unvan["id"]; ?>"><?php echo $unvan["unvan_ad"]; ?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                            <button type="button" class="btn btn-primary" id="kaydet">Kaydet</button>
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
                                                    <th>Ünvan</th>
                                                    <th>Name Surname</th>
                                                    <th>Section</th>
                                                    <th>E-Posta</th>
                                                    <th>Transactions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query=$db->query(" SELECT users.id,users.ad,users.soyad,users.email,bolumler.bolum_ad,titles.unvan_ad from advisor_details
INNER JOIN users ON users.id=advisor_details.danisman_id
INNER JOIN titles ON titles.id=advisor_details.title_id
INNER JOIN department ON bolumler.id=advisor_details.bolum_id");
                                            $danismanlar = $query->fetchAll(PDO::FETCH_ASSOC);

                                            ?>

                                            <?php foreach ($danismanlar as $danisman): ?>
                                                <tr>
                                                    <td><?php echo $danisman["id"]; ?></td>
                                                    <td><?php echo $danisman["unvan_ad"]; ?></td>
                                                    <td><?php echo $danisman["ad"]." ".$danisman["soyad"]; ?></td>
                                                    <td><?php echo $danisman["bolum_ad"] ?></td>
                                                    <td><?php echo $danisman["email"]; ?></td>
                                                    <td>
                                                        <a class="btn btn-danger" href="<?php echo "../ajax/danisman_sil.php?id=".$danisman["id"]; ?>">Sil</a>
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
        <div class="modal fade" id="unvan_ekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Title Transactions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body model-lg">
                        <form action="../ajax/unvan_kayit.php" method="post" id="unvan_form">

                            <div class="form-group">
                                <label for="inputAddress">Enter Title Name:</label>
                                <input type="text" name="unvan_ad" class="form-control" id="inputAddress" placeholder="Ünvan giriniz...">
                            </div>


                        </form>
                        <table class="table table-bordered">
                             <thead>
                                <tr>
                                    <th scope="col">Ünvan Adı:</th>
                                    <th scope="col">İşlem:</th>
                                </tr>
                             </thead>
                             <tbody>
                             <?php
                             $titles=$db->query("SELECT * FROM titles");
                             ?>
                             <?php foreach ($titles as $unvan): ?>
                                <tr>
                                    <td><?= $unvan["unvan_ad"] ?></td>
                                    <td>
                                        <a href="<?php echo "../ajax/unvan_sil.php?id=".$unvan["id"]; ?>" class="btn btn-danger">Sil</a>
                                    </td>
                                </tr>
                             <?php endforeach; ?>

                             </tbody>


                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" id="unvan_btn" class="btn btn-primary">Kaydet</button>
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
                    {targets:[5],searchable:false}
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

        $("#unvan_btn").click(function () {
            $("#unvan_form").submit();
        });

        $("#kaydet").click(function () {
            $("#danisman_kaydet").submit();
        });
    </script>


</body>

</html>

<?php }else{
    header("Location:../index.php");
}
?>