<?php
require_once('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$username = $_POST['username'];
	$name = $_POST['name'];
	$password = $_POST['password'];

	// Insert user into database
	$sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$password')";
	if (mysqli_query($conn, $sql)) {
		// Redirect to login page
		header("Location: login.php");
		exit();
	} else {
		$error = "Error: " . mysqli_error($conn);
	}
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register | Facebook</title>
	<!-- Include CSS and JS files here -->
    <style>
        

body {
  background-color: #f2f2f2;
  font-family: Arial, sans-serif;
}

.container {
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0px 0px 10px #ddd;
  margin: 50px auto;
  max-width: 500px;
  padding: 20px;
}

h2 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-sizing: border-box;
  display: block;
  font-size: 16px;
  padding: 10px;
  width: 100%;
}

button {
  background-color: #4CAF50;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 16px;
  padding: 10px;
}

button:hover {
  background-color: #3e8e41;
}

.error {
  color: red;
  margin-bottom: 10px;
}

p {
  margin-top: 20px;
  text-align: center;
}

a {
  color: #4CAF50;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

        </style>
</head>
<body>
	<div class="container">
		<h1>Register for Facebook</h1>
		<?php if (isset($error)): ?>
			<div class="alert alert-danger
            <?= $error ?>
		</div>
	<?php endif; ?>
	<form method="POST">
		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" id="username" name="username">
		</div>
		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name">
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password">
		</div>
		<button type="submit" class="btn btn-primary">Register</button>
	</form>
	<p>Already have an account? <a href="login.php">Log in here</a></p>
</div>
        </body>
        </html>