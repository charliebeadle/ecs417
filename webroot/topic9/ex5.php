<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 5</title>
</head>
<body>
<?php
	$prices = array(
		"4x100"=>2.39,
		"8x100"=>4.29,
		"4x100LL"=>3.95,
		"8x100LL"=>7,49,
		"batt"=>10.42
		);
		
	$sum = 0;
	
	if(isset($_POST['bulbs'])){
		$bulbs = $_POST['bulbs'];
		foreach($bulbs as $bulb){
			$sum += $prices[$bulb];
		}
	}
	
	$sum += $prices["batt"] * $_POST["batts"];
	
	$sum *= 1.2;
	
	echo "£".$sum;
	echo $_POST['card'];
	
?>
</body>
</html> 