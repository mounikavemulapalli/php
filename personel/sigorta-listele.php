<?php
session_start();
require "../config.php";
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
        <title>Personel | ÇÖMÜ STAJ TAKİP</title>

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
                            <h1 class="m-0">Insurance Record Listing Process</h1>
                        </div><!-- /.col -->
                        <!--                        <div class="col-sm-6">-->
                        <!--                            <ol class="breadcrumb float-sm-right">-->
                        <!--                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ekle_danisman">-->
                        <!--                                    Ekle-->
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
                                                <th>Tc</th>
                                                <th>Ögrenci No</th>
                                                <th>Tel</th>
                                                <th>Sigorta Giriş İşlemi</th>
                                                <th>Sigorta Çıkış İşlemi</th>
                                                <th>Staj Başlangıç Tarihi</th>
                                                <th>Staj Bitiş Tarihi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php


                                            $query=$db->query("SELECT internship_registration.id as kayit_id,CONCAT(ad,\" \",soyad) as tam_ad,tc,ogrenci_no,tel,sigorta_giris_onay,sigorta_cikis_onay,
DATE_FORMAT(staj_baslangic,\"%d-%m-%Y\") as staj_baslangic ,DATE_FORMAT(staj_bitis,\"%d-%m-%Y\") as staj_bitis FROM `internship_registration`
INNER JOIN Internship_date ON internship_registration.Internship_date_id=Internship_date.id
INNER JOIN student_details ON internship_registration.ogrenci_id=student_details.ogrenci_id
INNER JOIN users ON users.id = internship_registration.ogrenci_id

");

                                            $Staff = $query->fetchAll(PDO::FETCH_ASSOC);

                                            ?>

                                            <?php foreach ($Staff as $personel): ?>
                                                <tr>
                                                    <td><?php echo $personel["kayit_id"]; ?></td>
                                                    <td><?php echo $personel["tam_ad"]?></td>
                                                    <td><?php echo $personel["tc"] ?></td>
                                                    <td><?php echo $personel["ogrenci_no"] ?></td>
                                                    <td><?php echo $personel["tel"] ?></td>
                                                    <td>
                                                        <?php if ($personel["sigorta_giris_onay"]==1) { ?>
                                                            <div class="alert-success p-2" role="alert">
                                                                Tamamlandı
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="alert-warning p-2 text-white" role="alert">
                                                                Bekleniyor
                                                            </div>
                                                        <?php } ?>

                                                    </td>
                                                    <td>
                                                        <?php if ($personel["sigorta_cikis_onay"]==1) { ?>
                                                            <div class="alert-success p-2" role="alert">
                                                                Tamamlandı
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="alert-warning p-2 text-white" role="alert">
                                                                Bekleniyor
                                                            </div>
                                                        <?php } ?>

                                                    </td>
                                                    <td><?php echo $personel["staj_baslangic"]; ?></td>
                                                    <td><?php echo $personel["staj_bitis"]; ?></td>

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
        <div class="modal fade" id="duzenle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Danışman Düzenleme</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="../ajax/danisman_duzenle.php" method="post" id="danisman_duzenle">
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



                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">Section:</label>
                                    <select id="inputCity" name="bolum" class="form-control">
                                        <?php foreach ($department as $bolum): ?>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-primary">Değişiklikleri Kaydet</button>
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

    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

    <script>



        $(document).ready(function () {

            $('#example1 thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example1 thead');


            var table = $('#example1').DataTable({
                responsive: true,
                lengthChange: false,
                fixedHeader: true,
                orderCellsTop: true,
                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/tr.json"
                },
                columnDefs: [
                    {targets:[0],visible:false},
                    // {targets:[5],visible:false},
                    // {targets:[6],visible:false},
                    // {targets:[3],visible:false},
                    // {targets:[4],visible:false}
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
                }, "colvis",{
                    extend: 'collection',
                    text: 'Filter',
                    buttons: [
                        {
                            text: 'All',
                            action: function ( e, dt, node, config ) {
                                location.reload();
                            }
                        },
                        {
                            text: 'Those with Insurance Entry Completed',
                            action: function ( e, dt, node, config ) {
                                table.columns(5).search( "Tamamlandı" ).draw();
                            }
                        },
                        {
                            text: 'Those Awaiting Insurance Entry',
                            action: function ( e, dt, node, config ) {
                                table.columns(5).search( "Bekleniyor" ).draw();
                            }
                        },
                        {
                            text: 'Sigorta Çıkışı Tamamlananlar',
                            action: function ( e, dt, node, config ) {
                                table.columns(6).search( "Tamamlandı" ).draw();
                            }
                        },{
                            text: 'Sigorta Çıkışı Bekleyenler',
                            action: function ( e, dt, node, config ) {
                                table.columns(6).search( "Bekleniyor" ).draw();
                            }
                        },
                    ],
                    dropup: true,

                }],




                initComplete: function () {
                    setTimeout(function () {
                        table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    }, 10);

                    var api = this.api();

                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');

                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                }
            });


        });

    </script>


    </body>

    </html>

<?php }else{
    header("Location:../index.php");
}
?>