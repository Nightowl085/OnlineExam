<?php
    /**
     * Fungsi Aset -> Memanggil semua asset yang diperlukan, AdminLTE, BS3, FA, IONIcons, dll
     *
     * @return void
     */
    function assetLoad(){
        ?>
        <script src="asset/external/jquery/jquery.js"></script>
        <script src="asset/jquery-ui.min.js"></script>
        <link type="text/css" rel="stylesheet" href="asset/jquery-ui.min.css">
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
        <?php
    }
?>