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
<!--==================================================================-->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <link rel="stylesheet" href="style/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="style/login/login.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
  <script src="style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="jquery.min.js"></script>
  <script src="jquery.js"></script>

  <style type="text/css">
    
    .card_profile{
      justify-content: center;
      display: flex;
      align-items: center;
    }

    #errorField{
      justify-content: center;
      display: flex;
      align-items: center;
      margin-top: 10px;
      color:white;
      font-size: 20px;
      padding-left: 5px;
      border-radius: 5px;
      width:100%;
    }

    .card_title{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
/*        width: 70%; */
        text-align: center;
        background-color: white;
        font-family: sans-serif;
        font-weight: bold;
    }

    .card_title h2{
        font-family: serif;
        padding: 15px;
    }
    
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width:100%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
        text-align: center;
        font-family: serif;
    }


    #forgotpswd a{
      background-color: #fff;
      color: #4C489D;
      padding: 5px;
      border-radius:30px;
      box-shadow: 0px 2px 2px #5C5696;
      text-decoration: none;
      font-weight: 300;
    }

    #forgotpswd:hover{
      border-color: #6A679E;
      outline: none;
    }
  </style>

<!--===============================================================================================-->
</head>
<body>

    <?php echo $Reset_pswd_Through_Email.$MailerError.$Email_Not_Found;?>
      
     <div class="card_profile">

            <div class="card">
              
              <div class="card_title">
                  <h2><b>Fav system</b></h2>
              </div>

            </div>

     </div>
       
        <div class="container">
            <div class="screen">

              <div class="screen__content">
                <h1>Forgot&nbsp;&nbsp;&nbsp;<span style="color:white;">Password</span> </h1>
                <form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
                  <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="email" class="login__input" placeholder="Email" name="Username">
                  </div>
                 
                  <button class="button login__submit" type="submit">
                    <i class="button__icon fas fa-envelope"></i>&nbsp;&nbsp;
                    <span class="button__text">Send reset link</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                  </button>       
                </form>
                <!-- <div class="social-login">
                  <h3>log in via</h3>
                  <div class="social-icons">
                    <a href="#" class="social-login__icon fab fa-instagram"></a>
                    <a href="#" class="social-login__icon fab fa-facebook"></a>
                    <a href="#" class="social-login__icon fab fa-twitter"></a>
                  </div>
                </div> -->
                <div id="forgotpswd">
                  <a href="index.php"><i class="fas fa-chevron-left"></i>&nbsp; Back to login</a>
                </div>
              </div>
              <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>    
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
              </div>    
            </div>
          </div>

          <script>
              (function ($) {
                  "use strict";

                  var showPass = 0;
                  $('.btn-show-pass').on('click', function(){
                      if(showPass == 0) {
                          $(this).next('input').attr('type','text');
                          $(this).find('i').removeClass('zmdi-eye');
                          $(this).find('i').addClass('fas fa-eye');
                          showPass = 1;
                      }
                      else {
                          $(this).next('input').attr('type','password');
                          $(this).find('i').addClass('fas fa-eye');
                          $(this).find('i').removeClass('zmdi-eye');
                          showPass = 0;
                      }
                      
                  });
              })(jQuery);
          </script>


</body>
</html>