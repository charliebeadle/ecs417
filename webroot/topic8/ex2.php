<html>

<?php
	$name = $_POST['name'];
	$date = $_POST['dob'];
	$time = strtotime( $date );
	$since = time() - $time;
	$minutes = floor($since / 60);
	$hours = floor($minutes / 60);
	$days = floor($hours / 24);
	$weeks = floor($days / 7);
	$years = floor($days / 365.25);
	echo "Hi $name, your birthday is on: " . date("j-F-o", $time);
	echo "<br><br>Today's date is " . date("j F o");
	echo "<br><br>Since your birthday, $since seconds, $minutes minutes, $hours hours, $days days, $weeks weeks, or $years years have passed";

?>

</html>