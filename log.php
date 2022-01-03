<?php 
require_once 'config/config.php';
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- favicon -->
        <link rel="shortcut icon" href="assets/img/favicon.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/DataTables/css/dataTables.bootstrap4.min.css">
        <!-- datepicker CSS -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/datepicker/css/datepicker.min.css">
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/fontawesome-free-5.4.1-web/css/all.min.css">
        <!-- Sweetalert CSS -->
        <link rel="stylesheet" type="text/css" href="assets/plugins/sweetalert/css/sweetalert.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <!-- Fungsi untuk membatasi karakter yang diinputkan -->
        <script type="text/javascript" src="assets/js/fungsi_validasi_karakter.js"></script>

        <title>Log Counter</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
                <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fas fa-chart-bar title-icon"></i> Log Counter</h5>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table id="table-data" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Line</th>
                                <th>Model</th>
                                <th>OK</th>
                                <th>NG</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Duration</th>
                                <th>NG Detail</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal ubah Request -->
        <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetail" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Detail NG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUbah">
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="center">
                                    <tr>
                                        <th scope="col">Item</th>
                                        <th scope="col">Board 1</th>
                                        <th scope="col">Board 2</th>
                                        <th scope="col" id="sdb3">Board 3</th>
                                        <th scope="col" id="sdb4">Board 4</th>
                                    </tr>
                                    </thead>
                                    <tbody class="center">
                                        <?php $o = 1; $x = 1; ?>
                                        <?php $arr = ["Konektor Blow Hole","Konektor No Solder","MOV No Solder","Pin Konektor Short"] ?>
                                        <?php foreach($arr as $row) : ?>
                                        <tr>
                                            <td><?= $row ?></td>
                                            <td>
                                                <p id="<?= str_replace(" ", "", $row) ?>B1">0</p>
                                            </td>
                                            <td>
                                                <p id="<?= str_replace(" ", "", $row) ?>B2">0</p>
                                            </td>
                                            <td id="tdb3<?= $x++ ?>">
                                                <p id="<?= str_replace(" ", "", $row) ?>B3">0</p>
                                            </td>
                                            <td id="tdb4<?= $o++ ?>">
                                                <p id="<?= str_replace(" ", "", $row) ?>B4">0</p>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-reset" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="container-fluid">
            <footer class="pt-4 my-md-4 pt-md-3 border-top">
                <div class="row">
                    <div class="col-12 col-md center">
                        &copy; <?= date('Y') ?> - <a class="text-info" >PT. Astra Visteon Indonesia</a>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script type="text/javascript" src="assets/js/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="assets/js/popper.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <!-- fontawesome Plugin JS -->
        <script type="text/javascript" src="assets/plugins/fontawesome-free-5.4.1-web/js/all.min.js"></script>
        <!-- DataTables Plugin JS -->
        <script type="text/javascript" src="assets/plugins/DataTables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/plugins/DataTables/js/dataTables.bootstrap4.min.js"></script>
        <!-- datepicker Plugin JS -->
        <script type="text/javascript" src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <!-- SweetAlert Plugin JS -->
        <script type="text/javascript" src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>

        <script type="text/javascript">

            $(document).ready(function(){
                // initiate plugin ====================================================================================
                // ----------------------------------------------------------------------------------------------------

                // dataTables plugin
                $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var table = $('#table-data').DataTable( {
                    "bAutoWidth": false,
                    "scrollY": '58vh',
                    "scrollCollapse": true,
                    "processing": true,
                    "serverSide": true,
                    "ajax": 'data_log.php',     // panggil file data_log.php untuk menampilkan data transaksi dari database
                    "columnDefs": [ 
                        { "targets": 0, "data": null, "orderable": false, "searchable": false, "width": '30px', "className": 'center' },
                        { "targets": 1, "width": '130px', "className": 'center' },
                        { "targets": 2, "width": '130px', "className": 'center' },
                        { "targets": 3, "width": '130px', "className": 'center' },
                        { "targets": 4, "width": '130px', "className": 'center' },
                        { "targets": 5, "width": '130px', "className": 'center' },
                        { "targets": 6, "width": '130px', "className": 'center' },
                        { "targets": 7, "width": '130px', "className": 'center' },
                        {
                        "targets": 8, "data": null, "orderable": false, "searchable": false, "width": '120px', "className": 'center',
                        "render": function(data, type, row) {
                            var btn = "<a style=\"margin-right:7px\" title=\"Ubah\" class=\"btn btn-info btn-sm getUbah\" href=\"#\"><i class=\"fas fa-eye\"></i></a>";
                            return btn;
                        } 
                        } 
                    ],
                    "order": [[ 5, "desc" ]],           // urutkan data berdasarkan id_transaksi secara descending
                    "iDisplayLength": 10,               // tampilkan 10 data
                    "rowCallback": function (row, data, iDisplayIndex) {
                        var info   = this.fnPagingInfo();
                        var page   = info.iPage;
                        var length = info.iLength;
                        var index  = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                } );

                // Tampilkan Form Ubah Data
                $('#table-data tbody').on( 'click', '.getUbah', function (){
                    var data = table.row( $(this).parents('tr') ).data();
                    var id = data[ 8 ];
                    
                    $.ajax({
                        type : "GET",
                        url  : "get_detail.php",
                        data : {id:id},
                        dataType : "JSON",
                        success: function(result){
                            console.log(id);
                            console.log(result);
                            // tampilkan modal ubah data transaksi
                            $('#modalDetail').modal('show');
                            if(result.model == "K1ZA" || result.model == "K2PJ" || result.model == "K56R" || result.model == "K2PG") {
                                $('#sdb3').attr('hidden', true);
                                $('#sdb4').attr('hidden', true);
                                $('#tdb31').attr('hidden', true);
                                $('#tdb32').attr('hidden', true);
                                $('#tdb33').attr('hidden', true);
                                $('#tdb34').attr('hidden', true);
                                $('#tdb41').attr('hidden', true);
                                $('#tdb42').attr('hidden', true);
                                $('#tdb43').attr('hidden', true);
                                $('#tdb44').attr('hidden', true);
                            } else if (result.model == "K59" || result.model == "K1GA" || result.model == "K60" || result.model == "K2SA") {
                                $('#sdb3').attr('hidden', false);
                                $('#sdb4').attr('hidden', true);
                                $('#tdb31').attr('hidden', false);
                                $('#tdb32').attr('hidden', false);
                                $('#tdb33').attr('hidden', false);
                                $('#tdb34').attr('hidden', false);
                                $('#tdb41').attr('hidden', true);
                                $('#tdb42').attr('hidden', true);
                                $('#tdb43').attr('hidden', true);
                                $('#tdb44').attr('hidden', true);
                            } else {
                                $('#sdb3').attr('hidden', false);
                                $('#sdb4').attr('hidden', false);
                                $('#tdb31').attr('hidden', false);
                                $('#tdb32').attr('hidden', false);
                                $('#tdb33').attr('hidden', false);
                                $('#tdb34').attr('hidden', false);
                                $('#tdb41').attr('hidden', false);
                                $('#tdb42').attr('hidden', false);
                                $('#tdb43').attr('hidden', false);
                                $('#tdb44').attr('hidden', false);
                            }
                            // tampilkan data transaksi
                            $('#KonektorBlowHoleB1').text(result.kbhb1);
                            $('#KonektorBlowHoleB2').text(result.kbhb2);
                            $('#KonektorBlowHoleB3').text(result.kbhb3);
                            $('#KonektorBlowHoleB4').text(result.kbhb4);
                            $('#KonektorNoSolderB1').text(result.knsb1);
                            $('#KonektorNoSolderB2').text(result.knsb2);
                            $('#KonektorNoSolderB3').text(result.knsb3);
                            $('#KonektorNoSolderB4').text(result.knsb4);
                            $('#MOVNoSolderB1').text(result.mvsb1);
                            $('#MOVNoSolderB2').text(result.mvsb2);
                            $('#MOVNoSolderB3').text(result.mvsb3);
                            $('#MOVNoSolderB4').text(result.mvsb4);
                            $('#PinKonektorShortB1').text(result.pksb1);
                            $('#PinKonektorShortB2').text(result.pksb2);
                            $('#PinKonektorShortB3').text(result.pksb3);
                            $('#PinKonektorShortB4').text(result.pksb4);
                        }
                    });
                });
            });
        </script>
    </body>
</html>