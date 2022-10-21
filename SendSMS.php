<?php
use PHPMailer\PHPMailer\PHPMailer;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Send sms via phpcode</title>
  <link rel="card icon" href="style/dist/img/smartcard.jpg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="style/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="style/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="style/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="style/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="style/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="style/plugins/summernote/summernote-bs4.min.css">

  <!--custom css style-->
  <link rel="stylesheet" href="style/dist/css/index.css">

</head>
<body>

<br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
                
            <div class="card">
                    <div class="card-header" style="background-color: teal;color: white">
                        <h3 class="text-center">Send SMS</h3>
                    </div>

                <div class="card-body">
                	
                	<form action="" method="post">
					   <ul>
					      <li>
					       <label for="phoneNumber">Phone Number</label>
					       <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="0720000000" /></li>
					      <li>
					      <label for="carrier">Carrier</label>
					       <input type="text" name="carrier" id="carrier"  class="form-control" />
					      </li>
					      <li>
					       <label for="smsMessage">Message</label>
					       <textarea name="smsMessage" id="smsMessage" placeholder="Typing message . . . . ." cols="45" rows="5"  class="form-control"></textarea>
					      </li><br>
					     <button type="submit" name="sendMessage" class="btn btn-primary" id="sendMessage">Send&nbsp;<i class="fa fa-paper-plane"></i></button>
					   </ul>
					</form>

                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>

<!-- jQuery -->
<script src="style/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="style/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="style/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="style/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="style/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="style/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="style/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="style/plugins/moment/moment.min.js"></script>
<script src="style/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="style/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="style/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="style/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="style/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="style/dist/js/pages/dashboard.js"></script>

</body>
</html>

<?php
 
if ( isset( $_REQUEST ) && !empty( $_REQUEST ) ) {
 if (
 isset( $_REQUEST['phoneNumber'], $_REQUEST['carrier'], $_REQUEST['smsMessage'] ) &&
  !empty( $_REQUEST['phoneNumber'] ) &&
  !empty( $_REQUEST['carrier'] )
 ) {

  	$message = wordwrap( $_REQUEST['smsMessage'], 70 );
	
	$recipient = $_REQUEST['phoneNumber'];

	switch($_REQUEST['carrier']){
    	case "verizon":
    	    $recipient .= "@vtext.com";
    	break;

    	case "att":
    	    $recipient .= "@txt.att.net";
    	break;

    	case "tmobile":
    	    $recipient .= "@tmomail.net";
    	break;
	}

  $to = $recipient;
  $result = @mail( $to, '', $message );

  print 'Message was sent to ' . $to;
 } else {
  print 'Not all information was submitted.';
 }
}
 
?>