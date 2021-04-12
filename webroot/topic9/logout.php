<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 7</title>
</head>
<body>




	<?php
		if(isset($_POST['submit'])){
			session_start();
			session_unset();
			session_destroy();
			header("Location: ex7.php");
		}
	?>
</body>
</html> 