<?php
	require_once('common.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CoviDeal - The Covid-19 Test Information System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method = "post" id = "form" action = "/code/common.php">
					<span class="login100-form-title" style="background-color: black">
						CoviDeal Log In
					</span>
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<input class="input100" type="text" name="username" id="username" 
						placeholder="Username" pattern="[a-zA-Z ]+" 
						title="Username should contain only letters"
						required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Please enter password">
						<input class="input100" type="password" name="password" id="password"
						pattern="(?=.*\d)(?=.*[a-zA-Z]).{8,}"
						placeholder="Password" 
						title="Password should contain at least one number and one letter, and at least 8 or more characters"
						required>
						<span class="focus-input100"></span>
					</div>
					<div class="form-group">
						<div class="col-lg-12">
							<?php
							if (isset ($_SESSION['error'])) {
								echo $_SESSION['error'];
								unset($_SESSION['error']);} ?>
						</div>
					</div>
					<div class="p-t-10 p-b-23">
					</div>
					
					<div class="container-login100-form-btn">
						<input name="action_name" value="login" hidden>
						<input class="login100-form-btn" style="background-color: black"
						type="submit" class="btn btn-primary" name="submit" 
						id="submit" value="Login">
					</div>

					<div class="flex-col-c p-t-70 p-b-40">
					</div>
				</form>
			</div>
		</div>
	</div>	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/login.js"></script>
	<!--
	<script>
		var inputUsername = document.getElementById('username');
		inputUsername.oninvalid = function(event) {
		event.target.setCustomValidity('Username should contain at least 1 letter and 1 number in requested format. eg. Eyu123');
		}
		
		var inputPassword = document.getElementById('password');
		inputPassword.oninvalid = function(event) {
		event.target.setCustomValidity('Password should contain  at least one number, one uppercase, one lowercase, and at least 8 or more characters.');
		}
	</script>
	!-->
</body>
</html>