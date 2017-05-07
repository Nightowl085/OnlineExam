<?php
	ini_set('display_errors', 1);
	$modulTidakDiperlukan = ['isLoggedIn.php','logout.php'];
	include_once("module/module.php");
	if($error != "") echo $error;
?>
<form method="post">
	Username : <input type="text" name="user">
	Password : <input type="password" name="pass">
	<button type="submit" value="1" name="loginRequest">Login</button>
	Lupa?
</form>