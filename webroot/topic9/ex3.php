<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 3</title>
</head>
<body>
<?php
	$employee_salary = array();
	$employee_salary["Dave"] = 35000;
	$employee_salary["Steve"] = 56000;
	$employee_salary["Roger"] = 42000;
	$employee_salary["John"] = 12000;
	$employee_salary["Mike"] = 67000;
	
	
	function display($arr){
		foreach($arr as $k => $v){
			echo $k . ": " . $v . "<br>";
		}
	}
	
	display($employee_salary);
	echo "<br><br>";
	asort($employee_salary);
	display($employee_salary);
	echo "<br><br>";
	ksort($employee_salary);
	display($employee_salary);
	
	
?>
</body>
</html> 