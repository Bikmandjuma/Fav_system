<?php
require '..\phpcode\codes.php';
$users=new fac;

// $site=$_SESSION['sitename'];
// $entrance=$_SESSION['entrance'];

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fac_19_system</title>
  <link rel="card icon" href="../style/dist/img/smartcard.jpg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../style/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../style/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../style/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../style/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../style/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../style/plugins/summernote/summernote-bs4.min.css">
</head>

<body>

	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h2>
				This page is where we get requested id from rfid when card is tapped on rfid.

				but because our Rfid and NodeMcu not yet configured we use input field .
			</h2>

			<br>
			<br>

			<form method="POST">
				<label>Id Card</label>
				<input type="text" name="kid" class="form-control" autofocus required><br>
				<button name="submit" type="submit" class="btn btn-danger">Submit</button>
			</form>
			
			<?php
				if (isset($_POST['submit'])) {
					//$UIDresult=$_POST["UIDresult"];
					$UIDresult=$_POST["kid"];

					$Write="<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
					file_put_contents('UIDContainer.php',$Write);

					// $file = 'file.txt';
					// $data = "John Smith ";
					// $data .= "Street Address ";
					// $data .= "Plumber ";
					// $data .= "Phone nuber";
					// file_put_contents($file, $data,FILE_APPEND | LOCK_EX);
				}

			?>
		</div>
		<div class="col-md-3"></div>
	</div>

	<!-- jQuery -->
	<script src="../style/plugins/jquery/jquery.min.js"></script>
	<script src="../style/plugins/jquery/jquerys.js"></script>
	<script src="../style/plugins/jquery/jquery.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="../style/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<!-- Bootstrap 4 -->
	<script src="../style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="../style/plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="../style/plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="../style/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="../style/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="../style/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="../style/plugins/moment/moment.min.js"></script>
	<script src="../style/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="../style/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="../style/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="../style/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../style/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes --><!-- 
	<script src="../style/dist/js/demo.js"></script> -->
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="../style/dist/js/pages/dashboard.js"></script>


</body>
</html>
