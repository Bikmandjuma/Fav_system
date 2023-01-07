<!DOCTYPE html>
<html>
<head>
	<title>Get UID</title>
</head>
<body>
<form method="POST">
	<input type="text" name="cool">
	<button type="submit" name="submit">cool</button>
</form>

<?php
	$path='get_Content.php';
	$cool="Bikman djuma";
	$cool.="Ricardo";
	$text="<?php echo "."$"."name='".$cool."';"."?>";
	file_put_contents($path, $text,FILE_APPEND | LOCK_EX);
?>
</body>
</html>