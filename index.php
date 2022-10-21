<?php
session_start();
include_once('Connect/connection.php');
require 'phpcode/codes.php';
$users=new fac;
$incorectcredential=$allfieldRequired=$user=$pass=$PostionOptionisEmpty="";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $user=test_input($_POST['Username']);
    $pass=test_input($_POST['Password']);

    if (empty($user) || empty($pass)) {

        $allfieldRequired='
                  <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                      All fields are required !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
        ';

    }else{
        $query_user=mysqli_query($con,"SELECT u_id,firstname,lastname,gender,phone,email,dob,username,password,image,sitename FROM users where username='$user' and password='".md5($pass)."'");
          $row=mysqli_fetch_array($query_user);

        $query_admin=mysqli_query($con,"SELECT id,firstname,lastname,gender,phone,email,dob,username,password,image FROM admin where username='$user' and password='".md5($pass)."'");
          $row_admin=mysqli_fetch_array($query_admin);

          if ($row > 0) {
              session_start();
              $_SESSION['u_id']=$row[0];
              $_SESSION['firstname']=$row[1];
              $_SESSION['lastname']=$row[2];
              $_SESSION['gender']=$row[3];
              $_SESSION['phone']=$row[4];
              $_SESSION['email']=$row[5];
              $_SESSION['dob']=$row[6];
              $_SESSION['username']=$row[7];
              $_SESSION['password']=$row[8];
              $_SESSION['image']=$row[9];
              $_SESSION['sitename']=$row[10];
              header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/User/home.php");

          }elseif ($row_admin > 0) {
              $_SESSION['id']=$row_admin[0];
              $_SESSION['firstname']=$row_admin[1];
              $_SESSION['lastname']=$row_admin[2];
              $_SESSION['gender']=$row_admin[3];
              $_SESSION['phone']=$row_admin[4];
              $_SESSION['email']=$row_admin[5];
              $_SESSION['dob']=$row_admin[6];
              $_SESSION['username']=$row_admin[7];
              $_SESSION['password']=$row_admin[8];
              $_SESSION['image']=$row_admin[9];
              
              header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/Admin/home.php");

          }else{

              $incorectcredential='
                  <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                      Incorrect username/password , try again !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
              ';

          }
    }

}

function test_input($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
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

<div class="row">
    <div class="col-md-12 text-center" style="background-color: teal;color: white">
        <h2 style="font-family: initial;">Fav system</h2>
    </div>
</div>

<br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
                
            <div class="card">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <div class="card-header" style="background-color: teal;color: white">
                        <h3 class="text-center">Login here</h3>
                    </div>

                <div class="card-body">
                    <?php echo $allfieldRequired." ".$incorectcredential;?>
                    <div class="form-group">
                        <input type="email" class="form-control" name="Username" placeholder="Enter Email" autofocus>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="Password" placeholder="Enter password">
                    </div>

                    <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block ordering" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Adding"><i class="fa fa-lock-open"></i>&nbsp;Login</button>
                        </div>
                        <div class="col-md-5">
                            <a href="forgotpassword.php" class="float-right"><i class="fa fa-key"></i>&nbsp;Forgot password</a>
                        </div>
                    </div>      

                </form>

                </div>
            </div>

        </div>
        <div class="col-md-3"></div>
    </div>

      <script>
          $('.ordering').on('click', function() {
              var $this = $(this);
              $this.button('loading');
                 setTimeout(function() {
                   $this.button('reset');
               },8000);
            });
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
<!-- AdminLTE for demo purposes -->
<!-- <script src="style/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="style/dist/js/pages/dashboard.js"></script>

</body>
</html>
