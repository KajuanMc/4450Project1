<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="4450project1";

$dbc=mysqli_connect($hostname,$username,$password,$dbname) OR die("Cannot connect to database, error...");
echo "Connected to the database ".$dbname." successfully!<br>";
?>