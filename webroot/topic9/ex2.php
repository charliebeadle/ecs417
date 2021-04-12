<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <link rel="stylesheet" href="exercise1.css" />
 <title>Week 10 - Exercise 2</title>
</head>
<body>
<?php
	$arr = [0, 2, 3, 4, 5, 6, 2, 3, 1, 2];
	
	function calcMedian($nums){
		sort($nums);
		$count = count($nums) - 1;
		$min = floor($count / 2);
		$max = ceil($count / 2);
		$sum = $nums[$min] + $nums[$max];
		$median = $sum / 2;
		return $median;
	}
	
	function calcMean($nums){
		$sum = 0;
		
		foreach($nums as $num){
			$sum += $num;
		}
		
		$mean = $sum / count($nums);
		
		return $mean;		
	}
	
	echo "Mean: " . calcMean($arr) . "<br>Median: " . calcMedian($arr);
	
 ?>
</body>
</html> 