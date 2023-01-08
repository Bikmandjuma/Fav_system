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
        $query_user=mysqli_query($con,"SELECT u_id,firstname,lastname,gender,phone,email,dob,username,password,image,sitename,entrance,site_name.id as site_id FROM users inner join site_name on users.fk_sitename_id = site_name.id where username='$user' and password='".md5($pass)."'");
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
              $_SESSION['entrance']=$row[11];
              $_SESSION['site_id']=$row[12];

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
              $incorectcredential='<script type="text/javascript">toastr.error("Wrong credentials !")</script>';
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
<!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <span class="login100-form-title p-b-26">
            Login
        </span>
        <form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
          <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
            <input class="input100" type="email" name="Username" autofocus id="emailid">  
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Enter password">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="Password" id="passid">  
            <span class="focus-input100" data-placeholder="Password"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn" name="submit">
                Login
              </button>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <a href="">Forgot password</a>
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