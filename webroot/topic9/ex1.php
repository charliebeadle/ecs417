<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 1</title>
</head>
<body>
 <?php
 $count =1;
 while ($count <=100){
	if ($count % 2){
		print "<p> **** </p>";
	}else{
		print "<p> ++++++++</p>";
	};
	$count++;
 }
 ?>
</body>
</html> 