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
                  <div class="alert alert-danger text-center alert-dismissible fade show" role="alert"><b>
                      All fields are required !</b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
        ';

    }else{
        $query_user=mysqli_query($con,"SELECT u_id,firstname,lastname,gender,phone,email,dob,username,password,image FROM users where username='$user' and password='".md5($pass)."'");
          $row=mysqli_fetch_array($query_user);

        $query_admin=mysqli_query($con,"SELECT id,firstname,lastname,gender,phone,email,dob,username,password,image FROM admin where username='$user' and password='".md5($pass)."'");
          $row_admin=mysqli_fetch_array($query_admin);

          if ($row > 0) {
              // session_start();
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

              $diplic_online_user_sql=mysqli_query($con,"SELECT * from online_users where fk_user_id='".$row[0]."'");
              $diplic_online_user_nums=mysqli_num_rows($diplic_online_user_sql);
              date_default_timezone_set("Afrika/Kigali");
              $tm=date("Y-m-d H:i:s");
              $status="ON";
              $user_id=$row[0];

              if ($diplic_online_user_nums > 0) {
                  mysqli_query($con,"UPDATE online_users SET status='$status',period='$tm' where fk_user_id='".$user_id."' ");
              }else{
                  mysqli_query($con,"INSERT INTO online_users VALUES ('','$status','$tm','$user_id')");
              }

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
              $incorectcredential='<script type="text/javascript">toastr.error("Wrong credentials , try again  !")</script>';
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

<!--===============================================================================================-->

<style>
  ::-webkit-scrollbar{
    display: none;
  }

  .alert{
    padding: 15px;
    margin-bottom: 20px;border-radius: 4px;color: #fff;text-transform: uppercase;font-size: 12px}.alert_info{background-color: #4285f4;border: 2px solid #4285f4}button.close{-webkit-appearance: none;padding: 0;cursor: pointer;background: 0 0;border: 0}.close{font-size: 20px;color: #fff;opacity: 0.9;}.alert_success{background-color: #09c97f;border: 2px solid #09c97f}.alert_warning{background-color: #f8b15d;border: 2px solid #f8b15d}.alert_error{background-color: #f95668;border: 2px solid #f95668}.fade_info{background-color: #d9e6fb;border: 1px solid #4285f4}.fade_info .close{color: #4285f4}.fade_info strong{color: #4285f4}.fade_success{background-color: #c9ffe5;border: 1px solid #09c97f}.fade_success .close{color: #09c97f}.fade_success strong{color: #09c97f}.fade_warning{background-color: #fff0cc;border: 1px solid #f8b15d}.fade_warning .close{color: #f8b15d}.fade_warning strong{color: #f8b15d}.fade_error{background-color: #ffdbdb;border: 1px solid #f95668}.fade_error .close{color: #f95668}.fade_error strong{color: #f95668}


    #my_data p{
        display: inline-block;
    }

    .card_profile{
      justify-content: center;
      display: flex;
      align-items: center;
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
</style>
</head>
<body style="background-color:grey;">

 <div class="card_profile">

            <div class="card">
              
              <div class="card_title">
                  <h2><b>Fav system</b></h2>
              </div>

            </div>

  </div>


       <?php echo $incorectcredential;?>

        <div class="container">
            <div class="screen">

              <div class="screen__content">
                <h1>Logi<span style="color:white;">n here</span> </h1>
                <form class="login" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
                  <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="email" class="login__input" placeholder="Email" name="Username">
                  </div>
                  <div class="login__field">
                    <i class="login__icon fas fa-key"></i>
                    <input type="password" class="login__input" placeholder="Password" name="Password">
                  </div>
                  <button class="button login__submit" type="submit">
                    <i class="button__icon fas fa-lock-open"></i>&nbsp;&nbsp;
                    <span class="button__text">Login</span>
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
              </div>
              <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>    
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
              </div>    
            </div>
          </div>


</body>
</html>