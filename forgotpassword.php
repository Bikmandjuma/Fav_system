<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
include_once('Connect/connection.php');
$email_pswd_well=$email_pswd_wrong=$email_required=null;

if(isset($_POST['submit_forgot_pswd']) & !empty($_POST)){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $sql = "SELECT * FROM `admin` WHERE email = '$email'";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);

  if (empty($email)) {
    $email_required='<span class="text-danger"> Email field is required *</span>';
  }else{

      if($count == 1){
          require_once 'PHPMailer\PHPMailer.php';
          require_once 'PHPMailer\SMTP.php';
          require_once 'PHPMailer\Exception.php';

          $r = mysqli_fetch_assoc($res);
          $password = $r['password'];
          $link="<a href='ResetPassword.php'>Reset password</a>";

          try {

              //Server settings
              // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
              $mail=new PHPMailer();                     //Enable verbose debug output
              $mail->isSMTP();                                            //Send using SMTP
              $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
              $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
              $mail->Username   = 'indexzero900@gmail.com';                     //SMTP username
              $mail->Password   = 'minhlrhbyfaubvmi';                               //SMTP password
              $mail->SMTPSecure = 'tls' ; //tls;            //Enable implicit TLS encryption
              $mail->Port       = 587; //587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

              //Content
              $mail->isHTML(true); 
              $mail->setFrom($email,'Fac system');
              $mail->addAddress($email);               //Set email format to HTML
              $mail->Subject = "Your Recovered Password";
              $mail->Body    = "Please use this password to login " . $password;

              $mail->send();
              
              $email_pswd_well='
                  <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                        Check your email , we sent you a message !
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';

          } catch (Exception $e) {
              $MailerError='
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                  Message could not be sent. Mailer Error: {$mail->ErrorInfo}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              ';
          }
         

      }else{
          $email_pswd_wrong='
              <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                  This email not found in our records !
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:25px;">&times;</span>
                  </button>
              </div>';

      }
  }
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fac_19_system</title>
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
        <h2 style="font-family: initial;">FAC SYSTEM</h2>
    </div>
</div>

<br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">

                <?php
                  echo $email_pswd_well.$email_pswd_wrong;
                ?>
                <form method="POST">
                    <div class="card-header" style="background-color: teal;color: white">
                        <h3 class="text-center"><i class="fa fa-envelope"></i>&nbsp;E-mail</h3>
                    </div>

                <div class="card-body">
                    <div class="form-group">
                        <label><?php echo $email_required;?></label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email">
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block" name="submit_forgot_pswd"><i class="fa fa-paper-plane"></i>&nbsp;Send me reset link</button>
                        </div>
                        <div class="col-md-4">
                            <a href="index.php" class="float-right"><i class="fa fa-arrow-left"></i>&nbsp;Back to login</a>
                        </div>
                    </div>      

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
<!-- <script src="style/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="style/dist/js/pages/dashboard.js"></script>

</body>
</html>