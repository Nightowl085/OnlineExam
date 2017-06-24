<?php
    /**
     * Fungsi Aset -> Memanggil semua asset yang diperlukan, AdminLTE, BS3, FA, IONIcons, dll
     *
     * @return void
     */
    function assetLoad(){
        ?>
        <script src="asset/external/jquery/jquery.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="asset/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="asset/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="asset/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
            page. However, you can choose any other skin. Make sure you
            apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="asset/dist/css/skins/skin-blue.min.css">
        <!-- REQUIRED JS SCRIPTS -->
        <!-- Bootstrap 3.3.6 -->
        <script src="asset/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="asset/dist/js/app.min.js"></script>
        <!--BS3 Validatorjs-->
        <script src="asset/js/validator.min.js"></script>
        <!--OnlineExam Min-->
        <script src="asset/plugins/datatables/jquery.dataTables.min.js"></script>
        <!--BS DTB-->
        <script src="asset/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="asset/plugins/datatables/dataTables.bootstrap.css">

        <!-- bootstrap datepicker -->
        <script src="asset/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- bootstrap time picker -->
        <script src="asset/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <link rel="stylesheet" href="asset/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="asset/plugins/datepicker/datepicker3.css">

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
        <script src="asset/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="asset/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="asset/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <?php
    }
?>