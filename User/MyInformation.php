<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

include_once '../Connect/connection.php';
include_once '../phpcode/codes.php';

$auth_user_id=$_SESSION['u_id'];

$sql_user_info="SELECT * FROM users where u_id=".$auth_user_id."";
$query_user_info=mysqli_query($con,$sql_user_info);
while ($row_user_info=mysqli_fetch_assoc($query_user_info)) {
    $fname=$row_user_info['firstname'];
    $lname=$row_user_info['lastname'];
}

$sql_user_info="SELECT * FROM users where u_id=".$auth_user_id."";
$query_user_info=mysqli_query($con,$sql_user_info);
while ($row_user_info=mysqli_fetch_assoc($query_user_info)) {
    $user_id=$row_user_info['u_id'];
    $fnamex=$row_user_info['firstname'];
    $lnamex=$row_user_info['lastname'];
    $user_img=$row_user_info['image'];
    $phone=$row_user_info['phone'];
    $email=$row_user_info['email'];
    $gender=$row_user_info['gender'];
    $dob=$row_user_info['dob'];
    $uname=$row_user_info['username'];
}

$users=new fac;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My information</title>
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

  <style>
     #my_data p{
        display: inline-block;
    }

    ::-webkit-scrollbar{
      display: none;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <?php include_once 'modellogout.php';?>
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

      <li class="nav-item dropdown" style="margin-top:5px;">
        <i class="fa fa-lock"></i>&nbsp;<a style="color: black;font-family: initial;" href="" data-toggle="modal" data-target="#ModalLogout">Logout</a>
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
              <i class="nav-icon fas fa-cogs"></i>
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
  <div class="content-wrapper" style="background-color:lightgrey;">
    <!-- Content Header (Page header) -->
    <br>

        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
          <div class="card">
            <div class="card-header text-center bg-info"><i class="fa fa-address-card"></i>&nbsp;My information <a href="#" data-toggle="modal" data-target="#EditInfoModal" data-backdrop="static" data-keyboard="false"><button class="btn btn-light float-left"><i class="fa fa-edit"></i>&nbsp;Edit</button></a></div>
            <div class="card-body" style="overflow: auto;">

              <div class="row">
                  <div class="col-md-6 text-center">
                      <img src="../style/dist/img/<?php echo $users->User_Profile_Picture();?>" class="img-circle elevation-2" alt="User Image" style="width:100px;height:100px;border-radius:50%;border:1px solid skyblue;z-index: 1;display: relative;margin-top:5px; ">

                  </div>


                  <div class="col-sm-6">
                      <hr>

                      <div class="row">
                        <div class="col-md-12">
                          <span id="my_data"><p><b>Firstname :&nbsp;</b></p><p class="text-info"><b><?php echo $fnamex;?></b></p></span>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <span id="my_data"><p><b>Lastname :&nbsp;</b></p><p class="text-info"><b><?php echo $lnamex;?></b></p></span>
                         </div>
                      </div>
                
                  </div>
              </div>           
              
              <hr>

              <div class="row">
                  <div class="col-md-6">
                    <span id="my_data"><p><b>Gender :&nbsp;</b></p><p class="text-info"><b><?php echo $gender;?></b></p></span>
                  </div>

                  <div class="col-md-6">
                    <span id="my_data"><p><b>Phone :&nbsp;</b></p><p class="text-info"><b><?php echo $phone;?></b></p></span>
                  </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-md-6">
                  <span id="my_data"><p><b>Email :&nbsp;</b></p><p class="text-info"><b><?php echo $email;?></b></p></span>
                </div>

                <div class="col-md-6">
                  <span id="my_data"><p><b>Birth date :&nbsp;</b></p><p class="text-info"><b><?php echo $dob;?></b> </p></span>
                </div>
              </div>

               <hr>

              <div class="row">
                <div class="col-md-6">
                  <span id="my_data"><p><b>Username :&nbsp;</b></p><p class="text-info"><b><?php echo $uname;?></b>&nbsp;&nbsp;<a href="password.php"><i class="fa fa-pen"></i></a></p></span>
                </div>

                <div class="col-md-6">
                  <span id="my_data"><p><b>Role :&nbsp;</b></p><p class="text-info"><b>Manager</b></p></span>
                </div>
              </div>

              <!-- <div class="row">
                <div class="col-md-12">
                  <span id="my_data"><p><b>Site name :&nbsp;</b></p><p class="text-info"><b><?php //echo $site."<span style='color:black;'> at </span>".$entrance;?></b></p></span>
                </div>
              </div> -->
            
            </div>
          </div>
          
          <!--end of card-->
        </div>
        <div class="col-md-2"></div>
      </div>

       <!--start of Logout modal -->
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
        <!--end of logout modal-->

        <!--start of Logout modal -->
          <div class="modal" id="EditInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-body text-center">
                  <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <h4><u>Edit information&nbsp;<i class="fa fa-edit"></i></u></h4>
                </div>
                <div class="modal-body">
                  <div class="actionsBtns">
                     <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <div class="row">
                          <div class="col-md-6">

                            <label>Firstname</label>
                            <input type="text" name="fname" value="<?php echo $fname;?>" class="form-control" required>

                            <label>Lastname</label>
                            <input type="text" name="lname" value="<?php echo $lname;?>" class="form-control" required>

                            <label>Gender</label>
                            <select name="gender" class="form-control">
                              <?php
                                if ($gender == 'male') {
                                  ?>
                                      <option value='male' selected>Male</option>
                                      <option value='female'>Female</option>
                                  <?php
                                }else{
                                  ?>
                                      <option value='female' selected>Female</option>
                                      <option value='male'>Male</option>
                                  <?php
                                }
                              ?>
                            </select>

                          </div>
                          <div class="col-md-6">

                            <label>Phone</label>
                            <input type="text" name="phone" value="<?php echo $phone;?>" class="form-control" required>
                                
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $email;?>" class="form-control" required>

                            <label>Birth date</label>
                            <input type="date" name="dob" value="<?php echo $dob;?>" class="form-control" required>
                            
                          </div>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-4"></div>
                          <div class="col-md-4">
                            <button style="margin-top:6px;" class="btn btn-primary" type="submit" name="edit_info"><i class="fa fa-save"></i> Save change</button>
                          </div>
                          <div class="col-md-4"></div>
                        </div>

                      </form>

                  </div>
                </div>
              </div>
            </div>
          </div>
        <!--end of logout modal-->

        <?php
          $allfieldRequired=$dataUpdatedWell=null;
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $firstname=test_input($_POST['fname']);
              $lastname=test_input($_POST['lname']);
              $sex=test_input($_POST['gender']);
              $email=test_input($_POST['email']);
              $tel=test_input($_POST['phone']);
              $birthdate=test_input($_POST['dob']);

              if (isset($_POST['edit_info'])) {
                
                if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($sex) || empty($birthdate)) {
                    $allfieldRequired='<script type="text/javascript">toastr.error("All fields required !")</script>';
                }else{
                    
                    $sql="UPDATE users SET firstname='$firstname',lastname='$lastname',gender='$sex',phone='$tel',dob='$birthdate',email='$email' WHERE u_id='$user_id'";

                    $query=mysqli_query($con,$sql);

                    if ($query == 1) {
                      $dataUpdatedWell='<script type="text/javascript">toastr.success("Data updated successfully !")</script>';
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

          echo $allfieldRequired.$dataUpdatedWell;;
        ?>
  <!--End of wrapper content page-->
  </div>

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
