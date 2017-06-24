<?php
    if(isset($_POST['logoutRequest'])){
        $_SESSION['user'] = NULL; $_SESSION['posisi'] = NULL;
        session_destroy();
        header("Location: login.php");
        exit; // Jalan terakhir, ada masalah pada code, jadi intinya di break aja langsung hasilin header, daripada ga bisa logout
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
?>