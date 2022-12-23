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
                      Wrong credentials !
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
<!--   <link rel="stylesheet" href="style/dist/css/index.css">
 -->
 <style>
   body{
    background-image: url('style/dist/img/scard.png');
/*    background-repeat: no-repeat;
*/   }
 </style>
</head>
<body sty>

<div class="row">
    <div class="col-md-12 text-center" style="background-color: teal;color: white">
        <h2 style="font-family: initial;">Fav system</h2>
    </div>
</div>

<br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

          <div class="row" style="margin-top:50px;"  id="blink">
            <div class="col-md-12 text-center">
              <span style="margin-left:10px;font-size: 20px;" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#LoginModal"><i class="fa fa-user"></i>&nbsp;<a href="#" style="color:black;font-family:serif;">Login here</a></span>
            </div>
          </div>
                   
           <!--  <div class="card">
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
            </div> -->

            <div class="modal modal-child fade addNewRequestModal" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal" style="margin-top:95px;">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header bg-info">
                      <h4 class="modal-title" id="myModalLabel">Login here</h4>
                      <h4 class="modal-title" id="ForgotpswdTitle" style="display: none;">Forgot password</h4>
                      <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: white;">&times;</span>
                      </button>

                  </div>
                  
                  <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                      <?php echo $allfieldRequired." ".$incorectcredential;?>
                    </div>
                    <div class="col-md-2"></div>
                  </div>

                  <form id="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                      <div class="modal-body">

                        <label class="col-xs-2 col-form-label">Email</label>
                        <div class="input-group mb-3">
                          <input type="email" name="Username" class="form-control" placeholder="Enter email">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>

                        <label class="col-xs-2 col-form-label">Password</label>
                        <div class="input-group mb-3">
                          <input type="password" name="Password" id="AddPassword" class="form-control" placeholder="Enter password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        
                      </div>

                      <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" name="submit" onclick="myFunction()" class="btn btn-primary"><i class="fa fa-lock-open"></i>&nbsp;Login</button>
                      </div>

                      <div class="col-md-12 text-center">
                        <a href="#" onclick="HideLoginForm()"><i class="fa fa-key"></i>&nbsp;Forgot password</a>
                      </div>

                  </form>

                  <!--forgot password form-->
                  <form id="ForgotPasswordform" style="display: none;" action="" method="POST">
                      <div class="modal-body">

                        <label class="col-xs-2 col-form-label">Email</label>
                        <div class="input-group mb-3">
                          <input type="email" name="Username" class="form-control" placeholder="Enter email">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-envelope"></span>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="modal-footer" style="justify-content: center;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i>&nbsp;Reset email</button>
                      </div>

                      <div class="col-md-12 text-center">
                        <a href="#" onclick="ShowLoginForm()"><i class="fa fa-array-left"></i>&nbsp;Back to login</a>
                      </div>

                  </form>
                  <!--end of forgot password form-->

                </div>
              </div>
            </div>
          
        </div>
        <div class="col-md-3"></div>
    </div>

      <script>
          var uname=document.getElementById('User').val();
          var pswd=document.getElementById('Pass').val();

          if (isempty(uname)) {
            document.write('fill it !');
          }

          function HideLoginForm(){
              var loginform=document.getElementById('loginform');
              var title=document.getElementById('myModalLabel');
              loginform.style.display="none";
              title.style.display="none";

              var forgotpswdform=document.getElementById('ForgotPasswordform');
              var titleforgot=document.getElementById('ForgotpswdTitle');
              forgotpswdform.style.display="block";
              titleforgot.style.display="block";
          }

          function ShowLoginForm(){
            var loginform=document.getElementById('loginform');
              var title=document.getElementById('myModalLabel');
              loginform.style.display="block";
              title.style.display="block";

              var forgotpswdform=document.getElementById('ForgotPasswordform');
              var titleforgot=document.getElementById('ForgotpswdTitle');
              forgotpswdform.style.display="none";
              titleforgot.style.display="none";
          }

      </script>

      <script>
        //login text beeping
          var blink = document.getElementById('blink');
          setInterval(function() {
            blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
          }, 1000); 
      </script>

      <script>
        // function myFunction() {
        //     $("form").on("submit", function (event) {
        //         event.preventDefault();
        //         $.ajax({
        //             url: "yoururl",
        //             type: "POST",
        //             data: yourData,
        //             success: function (result) {
        //                 console.log(result)
        //             }
        //         });
        //     })
        // }

      </script>

      <script type="text/javascript">
        $(document).on("submit", "form", function(event)
        {
            event.preventDefault();        
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {


                }
            });        
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
<script src="jquery.min.js"></script>
<script src="jquery.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="style/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="style/dist/js/pages/dashboard.js"></script>

</body>
</html>
