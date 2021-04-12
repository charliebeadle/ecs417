<?php
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("DATABASE_USER");
	$dbpwd = getenv("DATABASE_PASSWORD");
	$dbname = getenv("DATABASE_NAME");

  GLOBAL $conn;
  $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }
?>
