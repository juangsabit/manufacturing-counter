<?php 
require_once 'config/config.php';
// var_dump($log_id); die;
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

        <title>Counter SMT</title>
        
        <script type="text/javascript">
            function timeNow() {
            var today = new Date(),
                curr_hour = today.getHours(),
                curr_min = today.getMinutes(),
                curr_sec = today.getSeconds();
            curr_hour = checkTime(curr_hour);
            curr_min = checkTime(curr_min);
            curr_sec = checkTime(curr_sec);
            document.getElementById('clock').innerHTML = "&nbsp" + curr_hour + ":" + curr_min + ":" + curr_sec;
            }

            function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
            }
            setInterval(timeNow, 500);
        </script>
    </head>
    <body id="body">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
                <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fas fa-chart-bar title-icon"></i> Counter</h5>
                <p class="my-0 font-weight-normal"><?= date("d M Y") ?> | </p>
                <p id="clock" class="my-0 font-weight-normal"></p>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <form id="formTambah">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group row">
                                  <div class="col-2">
                                    <label class="col-form-label">Line:  </label>
                                  </div>
                                  <div class="col-8">
                                    <select class="custom-select" id="line">
                                        <option value="">Select Line</option>
                                        <option value="Line-1">Line-1</option>
                                        <option value="Line-2">Line-2</option>
                                    </select>
                                  </div>
                                  <input type="hidden" name="line" id="valLine">
                                </div>
                                <div class="form-group row">
                                  <div class="col-2">
                                    <label class="col-form-label">Model:  </label>
                                  </div>
                                  <div class="col-8">
                                    <select class="custom-select" id="model">
                                        <option value="">Select Model</option>
                                        <?php
                                        $querymodel = $mysqli->query("SELECT * FROM model");
                                        $model = $querymodel->fetch_all(MYSQLI_ASSOC);
                                        $no = 1;
                                        foreach ($model as $row) {
                                        ?>
                                        <option value="<?= $row['model'] ?>"><?= $row['model'] ?></option>
                                        <?php } ?>
                                    </select>
                                  </div>
                                  <input type="hidden" name="model" id="valModel">
                                </div>
                            </div>
                            <div class="col-4 text-center">
                            </div>
                            <div class="col-4 text-right mt-4">
                                <button type="button" class="btn btn-info btn-submit mr-4" id="btnStart" onclick="startTimer()">START</button>
                                <input type="hidden" name="time" id="time" value="">
                                <input type="hidden" name="year" id="year" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="text-center">
                                    <div id="stopwatch">
                                        00:00:00
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-6">
                                <h4 class="mb-3 mr-md-auto font-weight-normal" id="okDisplay">0</h4>
                                <button type="button" style="width:50%; height:100px; margin : 2px;" class="btn btn-lg btn-success btn-submit" id="counterOk" onclick="addOk()">OK</button>
                                <input type="hidden" name="ok" value="0" id="okVal">
                            </div>
                            <div class="col-6">
                                <h4 class="mb-3 mr-md-auto font-weight-normal" id="ngDisplay">0</h4>
                                <button type="button" style="width:50%; height:100px; margin : 2px;" class="btn btn-lg btn-danger btn-submit" id="counterNg" onclick="addNg()">NG</button>
                                <input type="hidden" name="ng" value="0" id="ngVal">
                            </div>
                        </div>
                        <div class="row my-5">
                            <div class="col-12">
                                <div class="text-center mb-4">   
                                    <button type="button" class="btn btn-secondary btn-submit mr-4" id="btnEnd">END</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <h4 class="font-weight-normal my-5">Summary Detail NG</h4>
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
                                            <?php $ww = 1; $ss = 1; ?>
                                            <?php $i = 1; $p = 10; $r = 20; $w = 30 ?>
                                            <?php $q = 1; $v = 10; $b = 20; $n = 30 ?>
                                            <?php $t = 1; $y = 10; $k = 20; $o = 30 ?>
                                            <?php $arr = ["Konektor Blow Hole","Konektor No Solder","MOV No Solder","Pin Konektor Short"] ?>
                                            <?php foreach($arr as $row) : ?>
                                            <tr>
                                                <td><?= $row ?></td>
                                                <td>
                                                    <p id="colBoard1Display<?= $i++ ?>">0</p>
                                                    <input type="hidden" name="<?= str_replace(" ", "", $row) ?>B1" value="0" id="colBoard1Val<?= $t++ ?>">
                                                </td>
                                                <td>
                                                    <p id="colBoard2Display<?= $p++ ?>">0</p>
                                                    <input type="hidden" name="<?= str_replace(" ", "", $row) ?>B2" value="0" id="colBoard2Val<?= $y++ ?>">
                                                </td>
                                                <td id="tdb3<?= $ww++ ?>" >
                                                    <p id="colBoard3Display<?= $r++ ?>">0</p>
                                                    <input type="hidden" name="<?= str_replace(" ", "", $row) ?>B3" value="0" id="colBoard3Val<?= $k++ ?>">
                                                </td>
                                                <td id="tdb4<?= $ss++ ?>" >
                                                    <p id="colBoard4Display<?= $w++ ?>">0</p>
                                                    <input type="hidden" name="<?= str_replace(" ", "", $row) ?>B4" value="0" id="colBoard4Val<?= $o++ ?>">
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalNg" tabindex="-1" role="dialog" aria-labelledby="modalNg" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Detail NG</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formDetailNG">
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead class="center">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Board 1</th>
                                    <th scope="col">Board 2</th>
                                    <th scope="col" id="board3">Board 3</th>
                                    <th scope="col" id="board4">Board 4</th>
                                </tr>
                                </thead>
                                <tbody class="center">
                                    <?php $i = 1; $z = 1; $s = 1; $y = 1; ?>
                                    <?php $h = 10; $j = 10; ?>
                                    <?php $a = 20; $c = 20; ?>
                                    <?php $q = 30; $x = 30; ?>
                                    <?php $arr = ["Konektor Blow Hole","Konektor No Solder","MOV No Solder","Pin Konektor Short"] ?>
                                    <?php foreach($arr as $row) : ?>
                                    <tr>
                                        <td><?= $row ?></td>
                                        <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="<?= str_replace(" ", "", $row).$s ?>" class="custom-control-input" id="check<?= $i++ ?>">
                                            <label class="custom-control-label" for="check<?= $z++ ?>">&nbsp</label>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="<?= str_replace(" ", "", $row).($s+1) ?>" class="custom-control-input" id="check<?= $h++ ?>">
                                            <label class="custom-control-label" for="check<?= $j++ ?>">&nbsp</label>
                                        </div>
                                        </td>
                                        <td id="items<?= $y++ ?>">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="<?= str_replace(" ", "", $row).($s+2) ?>" class="custom-control-input" id="check<?= $a++ ?>">
                                            <label class="custom-control-label" for="check<?= $c++ ?>">&nbsp</label>
                                        </div>
                                        </td>
                                        <td id="item<?= $s++ ?>">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="<?= str_replace(" ", "", $row).($s+3) ?>" class="custom-control-input" id="check<?= $q++ ?>">
                                            <label class="custom-control-label" for="check<?= $x++ ?>">&nbsp</label>
                                        </div>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info btn-submit" id="btnDetailNG">Save</button>
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
            const timer = document.getElementById('stopwatch');

            var hr = 0;
            var min = 0;
            var sec = 0;
            var stoptime = true;


            function startTimer() {
                if (stoptime == true) {
                    if($('#model').val() == "K1ZA" || $('#model').val() == "K2PJ" || $('#model').val() == "K56R" || $('#model').val() == "K2PG"){
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
                    } else if ($('#model').val() == "K59" || $('#model').val() == "K1GA" || $('#model').val() == "K60" || $('#model').val() == "K2SA") {
                        $('#sdb4').attr('hidden', true);
                        $('#tdb41').attr('hidden', true);
                        $('#tdb42').attr('hidden', true);
                        $('#tdb43').attr('hidden', true);
                        $('#tdb44').attr('hidden', true);
                    }
                    // jika model kosong
                    if ($('#model').val()=="" && $('#line').val()==""){
                        // focus ke input model
                        $( "#line" ).focus();
                        // tampilkan peringatan data tidak boleh kosong
                        swal("Peringatan!", "Silahkan pilih line & model", "warning");
                    } else if ($('#model').val()=="") {
                        // focus ke input model
                        $( "#model" ).focus();
                        // tampilkan peringatan data tidak boleh kosong
                        swal("Peringatan!", "Silahkan pilih model", "warning");

                    } else if ($('#line').val()=="") {
                        // focus ke input model
                        $( "#line" ).focus()
                        // tampilkan peringatan data tidak boleh kosong
                        swal("Peringatan!", "Silahkan pilih line", "warning");

                    } else {
                        var today = new Date(),
                            curr_year = today.getFullYear(),
                            curr_month = today.getMonth()+1,
                            curr_day = today.getDate(),
                            curr_hour = today.getHours(),
                            curr_min = today.getMinutes(),
                            curr_sec = today.getSeconds();
                        curr_hour = checkTime(curr_hour);
                        curr_min = checkTime(curr_min);
                        curr_sec = checkTime(curr_sec);
                        function checkTime(i) {
                        if (i < 10) {
                            i = "0" + i;
                        }
                        return i;
                        }
                        var cYear = curr_year + "-" + curr_month + "-" + curr_day;
                        var cTime = curr_hour + "-" + curr_min + "-" + curr_sec;
                        $('#year').val(cYear);
                        $('#time').val(cTime);
                        var valModel =  $('#model').val()
                        $('#valModel').val(valModel);
                        $('#model').attr("disabled", true);
                        var valLine =  $('#line').val()
                        $('#valLine').val(valLine);
                        $('#line').attr("disabled", true);
                        swal("Berhasil!", "Sukses start", "success");
                        stoptime = false;
                        timerCycle();
                    }
                }
            }
            
            function stopTimer() {
                if (stoptime == false) {
                    stoptime = true;
                }
            }

            function timerCycle() {
                if (stoptime == false) {
                sec = parseInt(sec);
                min = parseInt(min);
                hr = parseInt(hr);

                sec = sec + 1;

                if (sec == 60) {
                min = min + 1;
                sec = 0;
                }
                if (min == 60) {
                hr = hr + 1;
                min = 0;
                sec = 0;
                }

                if (sec < 10 || sec == 0) {
                sec = '0' + sec;
                }
                if (min < 10 || min == 0) {
                min = '0' + min;
                }
                if (hr < 10 || hr == 0) {
                hr = '0' + hr;
                }

                timer.innerHTML = hr + ':' + min + ':' + sec;

                setTimeout("timerCycle()", 1000);
            }
            }

            function resetTimer() {
                timer.innerHTML = "00:00:00";
                stoptime = true;
                hr = 0;
                sec = 0;
                min = 0;
            }
        </script>

        <script type="text/javascript">
            var countOk = 0;
            var countNg = 0;
            var countcheck1 = 0; var countcheck2 = 0; var countcheck3 = 0; var countcheck4 = 0;
            var countcheck10 = 0; var countcheck11 = 0; var countcheck12 = 0; var countcheck13 = 0;
            var countcheck20 = 0; var countcheck21 = 0; var countcheck22 = 0; var countcheck23 = 0;
            var countcheck30 = 0; var countcheck31 = 0; var countcheck32 = 0; var countcheck33 = 0;

            function addOk() {
                // jika model kosong
                if ($('#model').val()!="" && $('#time').val()!=""){
                    countOk += 1;
                    $('#okDisplay').text(countOk);
                    $('#okVal').val(countOk);
                } else {
                    // focus ke input model
                    $( "#model" ).focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Pilih Model dan Klik Tombol Start", "warning");
                }
            }

            function addNg() {
                // jika model kosong
                if ($('#model').val()!="" && $('#time').val()!=""){
                    if($('#model').val() == "K1ZA" || $('#model').val() == "K2PJ" || $('#model').val() == "K56R" || $('#model').val() == "K2PG"){
                        $('#board3').attr('hidden', true);
                        $('#board4').attr('hidden', true);
                        $('#item1').attr('hidden', true);
                        $('#item2').attr('hidden', true);
                        $('#item3').attr('hidden', true);
                        $('#item4').attr('hidden', true);
                        $('#items1').attr('hidden', true);
                        $('#items2').attr('hidden', true);
                        $('#items3').attr('hidden', true);
                        $('#items4').attr('hidden', true);
                    } else if ($('#model').val() == "K59" || $('#model').val() == "K1GA" || $('#model').val() == "K60" || $('#model').val() == "K2SA") {
                        $('#board4').remove();
                        $('#item1').remove();
                        $('#item2').remove();
                        $('#item3').remove();
                        $('#item4').remove();
                    }
                    $('#modalNg').modal('show');
                    $('#formDetailNG')[0].reset();
                    // countNg += 1;
                    // $('#ngDisplay').text(countNg);
                    // $('#ngVal').val(countNg);
                } else {
                    // focus ke input model
                    $( "#model" ).focus();
                    // tampilkan peringatan data tidak boleh kosong
                    swal("Peringatan!", "Pilih Model dan Klik Tombol Start", "warning");
                }
            }

            $(document).ready(function(){
                $('#btnEnd').click(function(){
                    // jika model kosong
                    if ($('#model').val()!="" && $('#time').val()!=""){
                        swal({
                            title: "Apakah Anda Yakin?",
                            text: "Ingin mengakhiri perhitungan?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Ya, Yakin!",
                            closeOnConfirm: false
                        }, 
                        // jika dipilih ya, maka jalankan perintah hapus data
                        function () {
                            var data = $('#formTambah').serialize();
                            console.log(data);
                            $.ajax({
                                type : "POST",
                                url  : "proses_simpan.php",
                                data : data,
                                success: function(result){
                                    // ketika sukses menyimpan data
                                    if (result==="sukses") {
                                        // tampilkan pesan sukses simpan data
                                        swal("Sukses!", "Log berhasil disimpan.", "success");
                                        setInterval("window.location.reload()",2000);
                                    } else {
                                        // tampilkan pesan gagal simpan data
                                        swal("Gagal!", "Log tidak bisa disimpan.", "error");
                                    }
                                }
                            });
                        });
                    } else {
                        // focus ke input model
                        $( "#model" ).focus();
                        // tampilkan peringatan data tidak boleh kosong
                        swal("Peringatan!", "Pilih Model dan Klik Tombol Start", "warning");
                    }
                });

                // Proses Ubah Data
                $('#btnDetailNG').click(function(){
                    if ($('#check1').prop("checked") == false && $('#check2').prop("checked") == false 
                    && $('#check3').prop("checked") == false && $('#check4').prop("checked") == false 
                    && $('#check10').prop("checked") == false && $('#check11').prop("checked") == false 
                    && $('#check12').prop("checked") == false && $('#check13').prop("checked") == false
                    && $('#check20').prop("checked") == false && $('#check21').prop("checked") == false 
                    && $('#check22').prop("checked") == false && $('#check23').prop("checked") == false 
                    && $('#check30').prop("checked") == false && $('#check31').prop("checked") == false 
                    && $('#check32').prop("checked") == false && $('#check33').prop("checked") == false){
                        swal("Peringatan!", "Detail NG tidak boleh kosong.", "warning");
                    }
                    else{
                        countNg += 1;
                        $('#ngDisplay').text(countNg);
                        $('#ngVal').val(countNg);
                        if($('#check1').prop("checked") == true){
                            countcheck1 += 1; $('#colBoard1Display1').text(countcheck1); $('#colBoard1Val1').val(countcheck1);
                        }
                        if($('#check2').prop("checked") == true){
                            countcheck2 += 1; $('#colBoard1Display2').text(countcheck2); $('#colBoard1Val2').val(countcheck2);
                        }
                        if($('#check3').prop("checked") == true){
                            countcheck3 += 1; $('#colBoard1Display3').text(countcheck3); $('#colBoard1Val3').val(countcheck3);
                        }
                        if($('#check4').prop("checked") == true){
                            countcheck4 += 1; $('#colBoard1Display4').text(countcheck4); $('#colBoard1Val4').val(countcheck4);
                        }
                        if($('#check10').prop("checked") == true){
                            countcheck10 += 1; $('#colBoard2Display10').text(countcheck10); $('#colBoard2Val10').val(countcheck10);
                        }
                        if($('#check11').prop("checked") == true){
                            countcheck11 += 1; $('#colBoard2Display11').text(countcheck11); $('#colBoard2Val11').val(countcheck11);
                        }
                        if($('#check12').prop("checked") == true){
                            countcheck12 += 1; $('#colBoard2Display12').text(countcheck12); $('#colBoard2Val12').val(countcheck12);
                        }
                        if($('#check13').prop("checked") == true){
                            countcheck13 += 1; $('#colBoard2Display13').text(countcheck13); $('#colBoard2Val13').val(countcheck13);
                        }
                        if($('#check20').prop("checked") == true){
                            countcheck20 += 1; $('#colBoard3Display20').text(countcheck20); $('#colBoard3Val20').val(countcheck20);
                        }
                        if($('#check21').prop("checked") == true){
                            countcheck21 += 1; $('#colBoard3Display21').text(countcheck21); $('#colBoard3Val21').val(countcheck21);
                        }
                        if($('#check22').prop("checked") == true){
                            countcheck22 += 1; $('#colBoard3Display22').text(countcheck22); $('#colBoard3Val22').val(countcheck22);
                        }
                        if($('#check23').prop("checked") == true){
                            countcheck23 += 1; $('#colBoard3Display23').text(countcheck23); $('#colBoard3Val23').val(countcheck23);
                        }
                        if($('#check30').prop("checked") == true){
                            countcheck30 += 1; $('#colBoard4Display30').text(countcheck30); $('#colBoard4Val30').val(countcheck30);
                        }
                        if($('#check31').prop("checked") == true){
                            countcheck31 += 1; $('#colBoard4Display31').text(countcheck31); $('#colBoard4Val31').val(countcheck31);
                        }
                        if($('#check32').prop("checked") == true){
                            countcheck32 += 1; $('#colBoard4Display32').text(countcheck32); $('#colBoard4Val32').val(countcheck32);
                        }
                        if($('#check33').prop("checked") == true){
                            countcheck33 += 1; $('#colBoard4Display33').text(countcheck33); $('#colBoard4Val33').val(countcheck33);
                        }
                        swal("Sukses!", "Detail NG berhasil ditambahkan.", "success");
                        $('#modalNg').modal('hide');
                    }
                });
            });
        </script>
    </body>
</html>