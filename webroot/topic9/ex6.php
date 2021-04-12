<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 6</title>
</head>
<body>
<?php
	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "ecs417";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}
	
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$sql = "INSERT INTO USERS
							(firstName,	lastName,	email,		password)
					VALUES 	('$fname',	'$lname',	'$email',	'$password')";
		if($conn->query($sql) === TRUE){
			registrationSuccess();
			
		} else{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn -> close();
	}
	
	function registrationSuccess(){
		echo "
			<form onsubmit id=\"successful\"> 
				<legend>User Registration Form</legend>

				<br>
				
				Registration Successful
			
			</form>
		";
	}
?>
</body>
