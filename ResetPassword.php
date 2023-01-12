<?php
session_start();
include_once('Connect/connection.php');
require 'phpcode/codes.php';
$users=new fac;

$encrypted_email=$_REQUEST['email'];

// Store the cipher method
$ciphering = "AES-128-CTR";
  
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
  
// Non-NULL Initialization Vector for decryption
$decryption_iv = '1234567891011121';
  
// Store the decryption key
$decryption_key = "Fav";
  
// Use openssl_decrypt() function to decrypt the data
$decrypted_email=openssl_decrypt ($encrypted_email, $ciphering, 
        $decryption_key, $options, $decryption_iv);

$Invalid_email=$Valid_email=null;

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=test_input($_POST['email']);
    $new_pswd=test_input($_POST['new_Password']);
    $Conf_pswd=test_input($_POST['conf_Password']);

    if (isset($_POST['submit'])) {
            if ($decrypted_email != $email) {
                $Invalid_email='<script type="text/javascript">toastr.error("Invalid email !")</script>';
            }else {
                $Valid_email='<script type="text/javascript">toastr.success("Valid email !")</script>';
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
<?php echo $Invalid_email.$Valid_email; ?>
<div class="card">
  <div class="card-header bg-white float-left"><h3><b>Fav system</b></h3></div>
</div>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
          <span class="login100-form-title p-b-26">
              Reset password
          </span>
          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
            <input class="input100" type="email" name="email" autofocus>  
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="new_Password">  
            <span class="focus-input100" data-placeholder="New password"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="conf_Password">  
            <span class="focus-input100" data-placeholder="Confirm new password"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit">
                Save change
              </button>
            </div>
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