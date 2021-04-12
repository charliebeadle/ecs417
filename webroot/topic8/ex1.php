<?php
//console.log("test");

function display(){
	
	$names = array("David", "John", "Mark");

	$David = "£25,000";
	$John = "£37,000";
	$Mark = "$45,000";
	
	echo "<table><tr><th>Name</th><th>Salary</th></tr>";

	foreach($names as $name){
		echo  "<tr><td>$name</td><td>" . $$name . "</td></tr>";
	}

	echo "</table>";
}

?>
