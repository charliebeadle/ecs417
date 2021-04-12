<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 7</title>
</head>
<body>

	<?php
		session_start();
		if(isset($_SESSION['UserID'])){
			logoutForm();
		} else{
			if(isset($_POST['submit'])){
				checkLogin();
			} else{
				loginForm();
			}
		};


		function loginForm(){
			echo "<form action=". $_SERVER['PHP_SELF']." method='post' id='form'>";
			echo "<legend>Login</legend><br>";
			echo "<input type='email' name='email' id='email' required><br>";

			echo "<label for='Password'>Password:</label><br>";
			echo "<input type='password' name='password' id='password' required><br>";

			echo "<br><input type='submit' name='submit' id='submit'>";
			echo "</form>";
		};

		function checkLogin(){
			if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
				$servername = "127.0.0.1";
				$username = "root";
				$password = "";
				$dbname = "ecs417";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if($conn->connect_error){
					die("Connection failed: " . $conn->connect_error);
				}


				$email = $_POST['email'];
				$password = $_POST['password'];

				$sql = "SELECT ID FROM USERS WHERE
								email = \"$email\"
							AND	password = \"$password\"";
				$result = $conn->query($sql);
					if($result->num_rows == 1){
						echo "Login success.<br>";
						$arr = $result->fetch_assoc();
						echo "Welcome, ".$arr['ID'];
						$_SESSION['UserID'] = $arr['ID'];
						$conn -> close();
						logoutForm();
						return true;
					} else{
						echo "Login failed.";
					}
				$conn -> close();
				return false;
			};
		};

		function logoutForm(){
			echo "<form action='logout.php' method='post' id='form'>";
			echo "<legend>Logout</legend><br>";
			echo "<input type='submit' name='submit' id='submit'>";
			echo "</form>	";
		};
	?>
</body>
</html>
