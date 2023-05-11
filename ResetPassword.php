<?php
session_start();
include_once 'Connect/connection.php';
include_once 'phpcode/codes.php';
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
    // $email=test_input($_POST['email']);
    $new_pswd=test_input($_POST['new_Password']);
    $Conf_pswd=test_input($_POST['conf_Password']);

    if (isset($_POST['submit'])) {
        
            if ($new_pswd != $Conf_pswd) {
                $Password_dont_match='<script type="text/javascript">toastr.error("Password do not much!")</script>';
            }else {
                $query="UPDATE users SET password='$new_pswd' where email='$decrypted_email'";

                if ($query == true) {
                    $Password_changed_well='<script type="text/javascript">toastr.success("Password changed successfully !")</script>';

                    ?>
                      <script>
                        document.getElementById('forgotpswd').style.display="block";
                      </script>
                    <?php
                }

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

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <link rel="stylesheet" href="style/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="style/login/login.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,700">
  <script src="style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="jquery.min.js"></script>
  <script src="jquery.js"></script>

  <style>
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
      background-color:orange;
      color:white;
      padding:10px;
      border-radius:30px;
      box-shadow: 0px 2px 2px #5C5696;
      text-decoration: none;
    }

    #forgotpswd:hover{
      border-color: #6A679E;
      outline: none;
    }

  </style>

<!--===============================================================================================-->
</head>
<body>
<?php echo $Invalid_email.$Valid_email; ?>   

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
                <h1>Reset&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:white;">Password</span> </h1>
                <form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
                  <div class="login__field">
                    <i class="login__icon fas fa-key"></i>
                    <input type="password" class="login__input" placeholder="New password" name="new_Password">
                  </div>
                  <div class="login__field">
                    <i class="login__icon fas fa-key"></i>
                    <input type="password" class="login__input" placeholder="Comfirm new_Password" name="conf_Password">
                    <!-- <span class="btn-show-pass">
                      <i class="fas fa-eye"></i>
                    </span> -->
                  </div>
                  <button class="button login__submit" type="submit">
                    <i class="button__icon fas fa-save"></i>&nbsp;&nbsp;
                    <span class="button__text">Save changes</span>
                    <i class="button__icon fas fa-chevron-rightss"></i>
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
                <div id="forgotpswd" style="margin-top: -10px;display:none;">
                  <a href="index.php"> Go to login <i class="fas fa-chevron-right"></i></a>
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

              var blink = document.getElementById('forgotpswd');
              setInterval(function() {
                blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
              }, 1000); 
          </script>

</body>
</html>