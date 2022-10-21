<?php
$servername="localhost";
$username="root";
$password="";
$dbname="facdb";
$con=new mysqli($servername,$username,$password,$dbname);
if (!$con) {
	die("Connection error".mysqli_error($con));
}

?>