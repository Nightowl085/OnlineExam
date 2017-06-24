<?php
	ini_set('display_errors', 1);
	$modulTidakDiperlukan = ['isLoggedIn.php','logout.php'];
	include_once("module/module.php");
	if(isset($_SESSION['user'])){
		header("Location: dashboard.php");
	}
?>
<html>
	<head>
		<title>iSTTS Online Exam</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="iSTTS Online Exam">
		
		<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,800%7cRoboto:300,400,500,700" rel="stylesheet">
		<?php assetLoad(); ?>
		<link rel="stylesheet" href="asset/css/style.css">
		<link rel="icon" href="asset/img/istts.png">
	</head>
	<body>
		<header id="top-header" class="top-header section-bg overlay-black">
			<div class="verticle-center">
				<div class="container">
					<div class="row">
						<div class="display-flex">
							<div class="col-lg-7 col-md-6">
								<div class="logo">
									<img class="logoimg" src="asset/img/istts.png" alt="...">
								</div>
								<div class="logo">
									<h1><b>iSTTS Online Exam</b></h1>
									<p>Don't stress. Do your <u>best</u>. Forget the rest.</p>
								</div>
								<div></div>
							</div>
							<div class="col-lg-4 col-md-6 col-lg-offset-1">
								<form id="banner-signup" class="banner-signup text-center"  data-wow-duration="1.5s" action="#" method="post">
									<h3 class="signup-title">Welcome!</h3>
									<?php if($error != "") echo $error;?><br><br>
									<input type="text" name="user" placeholder="NRP" required>
									<input type="password" name="pass" placeholder="PASSWORD" required>
									<button type="submit" value="1" name="loginRequest" class="btn">LOGIN</button><br><br><br>
									<a href="resetPassword.php">Lupa Password?</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		
		<footer>
			<div class="container text-center">
				<p class="copyright">&copy; 2017 AVENGERS - APLIN iSTTS. All Rights Reserved.</p>
			</div>
		</footer>
		<script src="asset/js/bootstrap.min.js"></script>
	</body>
</html>