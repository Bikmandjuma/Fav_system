<?php
	include '../Connect/connection.php';
	$user_id=$_SESSION['u_id'];
	$result=mysqli_query($con,"UPDATE users SET image="user.png" where u_id='$user_id'");
	if ($result == true) {
		echo "picture trash well !";
	}else{
		echo "Error to trash picture !";
	}
?>