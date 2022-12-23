<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

require '../Connect/connection.php';
require '../phpcode/codes.php';

$Sitename=$_SESSION['sitename'];
$Entrance=$_SESSION['entrance'];

$Get_Card_id="UID".$Sitename.$Entrance;
?>