<!DOCTYPE html>
<html>
<head>
	<title>Modal</title>
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
</head>
<body>
<button data-target="#SimpleModalBox" data-toggle="modal">Click me</button>
<!--<SimpleModalBox>-->

<div class="modal fade" id="SimpleModalBox" tabindex="-1" role="dialog" aria-labelledby="SimpleModalLabel" aria-hidden="true">
  <!--<modal-dialog>-->
  <div class = "modal-dialog">

    <!--<modal-content>-->
    <div class = "modal-content">

      <div class = "modal-header">
        <button type = "button" class = "close" data-dismiss = "modal">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class = "modal-title" id = "SimpleModalLabel">Title for a simple modal</h4>
      </div>

      <div id="TheBodyContent" class = "modal-body">
        Put your content here
      </div>

      <div class = "modal-footer">
        <button type = "button" class = "btn btn-default" data-dismiss = "modal">Yes</button>
        <button type = "button" class = "btn btn-default" onclick="doSomethingBeforeClosing()">Don't close</button>
        <button type = "button" class = "btn btn-default" data-dismiss = "modal">Cancel</button>
      </div>

    </div>
    <!--<modal-content>-->

  </div>
  <!--/modal-dialog>-->
</div>
<!--</SimpleModalBox>-->
<script>

	//#region Dialogs
	function showSimpleDialog() {
	  $( "#SimpleModalBox" ).modal();
	}

	function doSomethingBeforeClosing() {
	  //Do something. For example, display a result:
	  $( "#TheBodyContent" ).text( "Operation completed successfully" );

	  //Close dialog in 3 seconds:
	  setTimeout( function() { $( "#SimpleModalBox" ).modal( "hide" ) }, 3000 );
	}

</script>

   
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
<script src="jquery.min.js"></script>
<script src="jquery.js"></script>
<script src="style/dist/js/pages/dashboard.js"></script>

</body>
</html>