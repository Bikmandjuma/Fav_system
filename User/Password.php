<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

include_once '../Connect/connection.php';
include_once '../phpcode/codes.php';

$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];

//call the card_id from RFID code when a card is taped on rfid device 
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);

$users=new fac;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modify password</title>
  <link rel="card icon" href="../style/dist/img/smartcard.jpg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../style/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../style/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../style/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../style/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../style/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../style/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../style/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../style/plugins/summernote/summernote-bs4.min.css">
  <script src="jquery.min.js"></script>
  <script src="jquery.js"></script>

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <style type="text/css">
    #card{
      background-repeat: no-repeat;
    }

    /*---------------------------------------------*/
.btn-show-pass {
  font-size: 15px;
  color: #999999;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  height: 100%;
  top: 0;
  right: 0;
  padding-right: 5px;
  cursor: pointer;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.btn-show-pass:hover {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}

.btn-show-pass.active {
  color: #6a7dfe;
  color: -webkit-linear-gradient(left, #21d4fd, #b721ff);
  color: -o-linear-gradient(left, #21d4fd, #b721ff);
  color: -moz-linear-gradient(left, #21d4fd, #b721ff);
  color: linear-gradient(left, #21d4fd, #b721ff);
}

#editUsername:hover{
  cursor: pointer;
}

#defaultUsername p{
  font-weight: bold;
}

#ShowPswd1,#ShowPswd2,#ShowPswd3,#ShowPswdSlash1,#ShowPswdSlash2,#ShowPswdSlash3{
    margin-top:10px;margin-left: -25px;
}

#ShowPswd1:hover,#ShowPswd2:hover,#ShowPswd3:hover,#ShowPswdSlash1:hover,#ShowPswdSlash2:hover,#ShowPswdSlash3:hover{
    cursor: pointer;
}

  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Manager panel</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" action="search.php" method="POST">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="date" aria-label="Search" title=" Click to select date !" name="search_data">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit" name="submit_searchdata">
                  <i class="fas fa-search" title="click to search data"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times" title="close search input"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#">
          <i class="fas fa-user"></i>
        </a>
      </li> -->
      <li class="nav-item dropdown" style="margin-top:5px;">
        <i class="fa fa-lock"></i>&nbsp;<a style="color: black;font-family: initial;" href="" data-toggle="modal" data-target="#logoutModal">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="../style/dist/img/faclogo.png" alt="Fac_system Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo  $users->Fetch_System_name();?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../style/dist/img/<?php echo $users->User_Profile_Picture();?>" class="img-circle elevation-2" alt="User Image" style='border:1px solid white;'>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $fname." ".$lname;?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Citizen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Register_Citizen.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add citizen card info</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="CheckCitizenInfo.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Check Card info</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Citizen_attendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Citizens attendance</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="AllCitizen_info.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All citizens info</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Citizen_attends_today.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's attendance</p>
                </a>
              </li>

            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Archive
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="archive_data.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Archive data</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="MyInformation.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Password.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Profile.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>

            </ul>
          </li>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  style="background-color:lightgrey;">
    <!-- Content Header (Page header) -->
    <br>
       <?php 
            require '../Connect/connection.php';

              $all_fields_required=$new_password=$confirm_new_password=$password_required=$current_password_incorrect=$password_mustbe_greaterthan_8=$new_password_do_not_match=$Password_changed_well=$user_new_pswd=null;

              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  if (isset($_POST['submit_pswd'])) {
                      $current_password=test_input($_POST['current_password']);
                      $new_password=test_input($_POST['new_password']);
                      $confirm_new_password=test_input($_POST['confirm_new_password']);

                      $sql="SELECT password from users where email='".$_SESSION['email']."'";
                      $result=mysqli_query($con,$sql);
                      while ($row=mysqli_fetch_assoc($result)) {
                          $user_password=$row['password'];
                      }

                      if (empty($current_password) || empty($new_password) || empty($new_password)) {
                          $all_fields_required='
                                          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                                      All fields are required !
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:25px;">&times;</span>
                                                      </button>
                                                  </div>';

                      }else{
                            if (md5($current_password) != $user_password) {
                                $current_password_incorrect='
                                                  <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                                      Incorrect current password !
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:25px;">&times;</span>
                                                      </button>
                                                  </div>';
                            }elseif (strlen($new_password) <= 8) {
                                $password_mustbe_greaterthan_8='
                                             <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                                      New password must be at least 8 characters !
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:25px;">&times;</span>
                                                      </button>
                                                  </div>';
                            }elseif (md5($new_password) != md5($confirm_new_password)) {
                                $new_password_do_not_match='
                                                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                                                      New password do not match !
                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" style="font-size:25px;">&times;</span>
                                                      </button>
                                                  </div>';

                            }else{ 
                                $user_new_pswd=md5($new_password);
                                if ($new_password == $confirm_new_password) {
                                    $sql_password="UPDATE users SET password='".$user_new_pswd."' where email='".$_SESSION['email']."'";
                                    $result_password=mysqli_query($con,$sql_password);
                                    if ($result_password == true) {
                                        $Password_changed_well='
                                                  <script>toastr.success("Password changed successfully !")</script>';
                                    }

                                }else{
                                    echo "<script>toastr.error('password can not be changed !')</script>";
                                }
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

              $Username_changed=$username_data=null;
              $user_id=$_SESSION['u_id'];
              
              if (isset($_POST['SubmitUsernameChanges'])) {
                $username=$_POST['username'];
                $query=mysqli_query($con,"UPDATE users SET username='$username' where u_id='$user_id' ");

                if ($query == true) {
                  $Username_changed='<script>toastr.info("Username changed well !")</script>';
                }

              }

              //select username
              $query_username=mysqli_query($con,"SELECT username from users where u_id='$user_id' ");
              while ($row=mysqli_fetch_assoc($query_username)) {
                $username_data=$row['username'];
              }


            ?>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-3 text-center">
            <?php echo $Username_changed;?>
            <span class="card">
              <div class="card-header bg-light"><i class="fas fa-user"></i> Modify username</div>
              <div class="card-body" id="defaultUsername"><p><?php echo $username_data;?> <i class="fas fa-edit float-right text-primary" id="editUsername" onclick="EditUsernamefn()"></i></p> </div>
              <div class="card-body" id="formUsername" style="display: none;">
                <form class="d-flex" method="POST">
                  <input type="email" class="form-control" name="username" required value="<?php echo $username_data;?>">&nbsp;
                  <button class="btn btn-info" type="submit" name="SubmitUsernameChanges"><i class="fas fa-save"></i></button>
                </form>
              </div>

            </span>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-4">
          <?php echo $Password_changed_well;?>
          <?php echo $all_fields_required;?>
          <?php echo $current_password_incorrect;?>
          <?php echo $new_password_do_not_match;?>
          <?php echo $password_mustbe_greaterthan_8;?>
          
          <div class="card">
            
            <div class="card-header text-center bg-info"><i class="fa fa-edit"></i>&nbsp;Modify password</div>
            <div class="card-body" style="overflow: auto;">
               <form class="form-group" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                  <br><!-- 
                  <span class="btn-show-pass">
                    <i class="fa fa-eye"></i>
                  </span> -->
                  <div class="d-flex">
                    <input type="password" name="current_password" placeholder="Current Password" class="form-control" id="pswdid1">
                    <i class="fas fa-eye-slash" id="ShowPswd1" onclick="ShowPswdFn1()"></i>
                    <i class="fas fa-eye" id="ShowPswdSlash1" onclick="ShowPswdFn11()" style="display:none;"></i>
                  </div>
                  <br>
                  <div class="d-flex">
                    <input type="password" name="new_password" placeholder="New Password" class="form-control" id="pswdid2"><br>
                    <i class="fas fa-eye-slash" id="ShowPswd2" onclick="ShowPswdFn2()"></i>
                    <i class="fas fa-eye" id="ShowPswdSlash2" onclick="ShowPswdFn22()" style="display:none;"></i>

                  </div>
                  <br>
                  <div class="d-flex">
                    <input type="password" name="confirm_new_password" class="form-control" placeholder="confirm New Password" id="pswdid3">
                    <i class="fas fa-eye-slash" id="ShowPswd3" onclick="ShowPswdFn3()"></i>
                    <i class="fas fa-eye" id="ShowPswdSlash3" onclick="ShowPswdFn33()" style="display:none;"></i>

                  </div>
                    <br>
                  <button class="btn btn-info" type="submit" name="submit_pswd"><i class="fa fa-save fa-fw"></i> &nbsp;Save change</button>
                </form>
            </div>
          </div>
          
          <!--end of card-->
        </div>
        <div class="col-md-2"></div> 
      </div>

        <!-- Logout model -->
          <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm text-center">
              <div class="modal-content">
                <div class="modal-body">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h5>Logout your account</h5>
                </div>
                <div class="modal-body">
                  <p><i class="fa fa-question-circle"></i>Are you sure , you want to log-off ? <br /></p>
                  <div class="actionsBtns">
                      <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                      <a href="../Logout.php" class="btn btn-primary"><i class="fa fa-lock"></i> Logout</a>
                      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--end of logout model-->

  <!--End of wrapper content page-->
  </div>

  <script>
    
    function EditUsernamefn(){
      var defaultUsername=document.getElementById('defaultUsername');
      var formUsername=document.getElementById('formUsername');
      defaultUsername.style.display="none";
      formUsername.style.display="block";

    }

    function ShowPswdFn1(){
      var x=document.getElementById('pswdid1');

      if (x.type === "password") {
        x.type = "text";
        document.getElementById('ShowPswdSlash1').style.display="block";
        document.getElementById('ShowPswd1').style.display="none";
      }else{
        x.type="password";
      }

    }

    function ShowPswdFn11(){
      var x=document.getElementById('pswdid1');

      if (x.type === "text") {
        x.type = "password";
        document.getElementById('ShowPswdSlash1').style.display="none";
        document.getElementById('ShowPswd1').style.display="block";
      }else{
        x.type="password";
      }

    }


    function ShowPswdFn2(){
      var x=document.getElementById('pswdid2');

      if (x.type === "password") {
        x.type = "text";
        document.getElementById('ShowPswdSlash2').style.display="block";
        document.getElementById('ShowPswd2').style.display="none";
      }else{
        x.type="password";
      }

    }

    function ShowPswdFn22(){
      var x=document.getElementById('pswdid2');

      if (x.type === "text") {
        x.type = "password";
        document.getElementById('ShowPswdSlash2').style.display="none";
        document.getElementById('ShowPswd2').style.display="block";
      }else{
        x.type="text";
      }

    }

    function ShowPswdFn3(){
      var x=document.getElementById('pswdid3');

      if (x.type === "password") {
        x.type = "text";
        document.getElementById('ShowPswdSlash3').style.display="block";
        document.getElementById('ShowPswd3').style.display="none";
      }else{
        x.type="password";
      }

    }

    function ShowPswdFn33(){
      var x=document.getElementById('pswdid3');

      if (x.type === "text") {
        x.type = "password";
        document.getElementById('ShowPswdSlash3').style.display="none";
        document.getElementById('ShowPswd3').style.display="block";
      }else{
        x.type="text";
      }

    }
  </script>

<!-- jQuery -->
<script src="../style/plugins/jquery/jquery.min.js"></script>
<script src="../style/plugins/jquery/jquerys.js"></script>
<script src="../style/plugins/jquery/jquery.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../style/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="../style/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../style/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../style/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../style/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../style/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../style/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../style/plugins/moment/moment.min.js"></script>
<script src="../style/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../style/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../style/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../style/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../style/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes --><!-- 
<script src="../style/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../style/dist/js/pages/dashboard.js"></script>

</body>
</html>
