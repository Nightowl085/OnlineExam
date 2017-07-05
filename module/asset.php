<?php
    /**
     * Fungsi Aset -> Memanggil semua asset yang diperlukan, AdminLTE, BS3, FA, IONIcons, dll
     *
     * @return void
     */
    function mainStyle(){
?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>iSTTS Online Exam</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="asset/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="asset/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="asset/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="asset/dist/css/skins/skin-blue.min.css">
<?php 
    }
    function datePickStyle(){
?>
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="asset/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="asset/plugins/daterangepicker/daterangepicker.css">
<?php
    }
    function dataTableStyle(){
?>
        <!-- DataTable -->
        <link rel="stylesheet" href="asset/plugins/datatables/dataTables.bootstrap.css">
        <style>td{vertical-align:middle!important}</style>
<?php
    }
    function mainScript(){
?>
        <!-- REQUIRED JS SCRIPTS -->
        <!--jQuery -->
        <script src="asset/external/jquery/jquery.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="asset/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="asset/dist/js/app.min.js"></script>
<?php
    }
    function validatorScript(){
?>
        <!--BS3 Validatorjs-->
        <script src="asset/js/validator.min.js"></script>
<?php
    }
    function dataTableScript(){
?>
        <!--BS DTB-->
        <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
<?php
    }
    function inputMaskScript(){
?>
        <!--InputMask -->
        <script src="asset/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="asset/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="asset/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<?php
    }
    function datePickScript(){
?>
        <!-- bootstrap datepicker -->
        <script src="asset/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- bootstrap time picker -->
        <script src="asset/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <script>
            $(function(){
                // $(".datepicker").datepicker("option", "dateFormat", "dd-mm-YYYY");
                // //Date picker
                // $('.datepicker').datepicker({
                //     autoclose: true
                // });
                $('.datepicker').datepicker({
                    autoclose: true
                });

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false,
                    showMeridian: false
                });
            });
        </script>
<?php
    }
?>