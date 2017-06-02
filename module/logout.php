<?php
    if(isset($_POST['logoutRequest'])){
        $_SESSION['user'] = NULL; $_SESSION['posisi'] = NULL;
        session_destroy();
        header("Location: login.php");
    }

    /**
     * Fungsi Panggil Form Log out
     *
     * @return void karena ga ngapa2in
     */
    function logout(){
        echo"<form method='post'>
            <button name='logoutRequest' value='1' class='btn btn-default btn-flat'>LogOut</button>
        </form>";
    }