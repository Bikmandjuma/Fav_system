<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
include_once('Connect/connection.php');
$Reset_pswd_Through_Email=$Email_Not_Found=$MailerError=null;

if(isset($_POST['submit_forgot_pswd']) & !empty($_POST)){
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $sql = "SELECT * FROM `admin` WHERE email = '$email'";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);

  if (empty($email)) {
      $email_required='<script type="text/javascript">toastr.error("Email field is required !")</script>';
  }else{

      if($count == 1){
          require_once 'PHPMailer\PHPMailer.php';
          require_once 'PHPMailer\SMTP.php';
          require_once 'PHPMailer\Exception.php';

          $r = mysqli_fetch_assoc($res);
          $password = $r['password'];
          $link="<a href='ResetPassword.php'>Reset password</a>";

          //Encrypting email
          $email_string=$email;

          // Store the cipher method
          $ciphering = "AES-128-CTR";

          // Use OpenSSl Encryption method
          $iv_length = openssl_cipher_iv_length($ciphering);
          $options = 0;

          // Non-NULL Initialization Vector for encryption
          $encryption_iv = '1234567891011121';

          // Store the encryption key
          $encryption_key = "Fav";

          // Use openssl_encrypt() function to encrypt the data
          $encrypted_email = openssl_encrypt($email_string, $ciphering,
            $encryption_key, $options, $encryption_iv);

          try {

              //Server settings
              // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
              $mail=new PHPMailer();                     //Enable verbose debug output
              $mail->isSMTP();                                            //Send using SMTP
              $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
              $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
              $mail->Username   = 'indexzero900@gmail.com';                     //SMTP username
              $mail->Password   = 'jpqtlaopdivilmaf';                               //SMTP password
              $mail->SMTPSecure = 'tls' ; //tls;            //Enable implicit TLS encryption
              $mail->Port       = 587; //587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

              //Content
              $mail->isHTML(true); 
              $mail->setFrom($email,'Fav-system');
              $mail->addAddress($email);               //Set email format to HTML
              $mail->Subject = "Your Recovered Password";
              $mail->Body    = "Please use this link to reset password " .'<a href="http://localhost/Project/Fac_smart_card/ResetPassword.php?email='.$encrypted_email.'">Reset Password here : '.$encrypted_email.'</a>';

              $mail->send();
              
              $Reset_pswd_Through_Email='<script type="text/javascript">toastr.success("Check your email , we sent you a message !")</script>';

          } catch (Exception $e) {
              $MailerError='<script type="text/javascript">toastr.error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}")</script>';            
          }
         
      }else{
          $Email_Not_Found='<script type="text/javascript">toastr.error("Email not found in our records !")</script>';  
      }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FAV_system</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
<!--   <link rel="icon" type="image/png" href="style/login_page/images/icons/favicon.ico"/>
 -->  <link rel="icon" type="image/png" href="style/dist/img/smartcard.jpg"/>

<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="style/login_page/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="style/login_page/css/util.css">
  <link rel="stylesheet" type="text/css" href="style/login_page/css/main.css">


  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <link rel="stylesheet" href="style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <script src="style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--===============================================================================================-->
</head>
<body>
<div class="card">
  <div class="card-header bg-white float-left"><h3><b>Fav system</b></h3></div>
</div>

<?php echo $Reset_pswd_Through_Email.$MailerError.$Email_Not_Found;?>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100" >
        <form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
          <span class="login100-form-title p-b-26">
              Email
          </span>
          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
            <input class="input100" type="email" name="email" autofocus id="emailid">  
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit_forgot_pswd">
                Send me reset link
              </button>
            </div>
          </div>

            <div>
                <a href="index.php">Back to Login</a>
            </div>

        </form>

      </div>
    </div>
  </div>

  <div id="dropDownSelect1"></div>
  
<!--===============================================================================================-->
  <script src="style/login_page/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/vendor/bootstrap/js/popper.js"></script>
  <script src="style/login_page/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/vendor/daterangepicker/moment.min.js"></script>
  <script src="style/login_page/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="style/login_page/js/main.js"></script>

</body>
</html>