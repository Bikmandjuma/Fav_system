<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}
$admin_id=$_SESSION['id'];
$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];
$phone=$_SESSION['phone'];
$email=$_SESSION['email'];
$gender=$_SESSION['gender'];
$dob=$_SESSION['dob'];

require '..\phpcode\codes.php';
$users=new fac;
$users->register_user();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin panel</title>
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
  <style type="text/css">
    #card{
      background-repeat: no-repeat;
    }
   #my_data p{
        display: inline-block;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#eee;">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Admin panel</a>
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
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
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
        <i class="fa fa-lock"></i>&nbsp;<a style="color: black;font-family: initial;" href="../Logout.php" onclick="return confirm('Do u want to logout your account ?');">Logout</a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home.php" class="brand-link">
      <img src="../style/dist/img/card.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Fac smart card</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../style/dist/img/<?php echo $user_img;?>" class="img-circle elevation-2" alt="User Image">
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
          <li class="nav-item">
            <a href="home.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Sites
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Regions</p>
                </a>
              </li>

            </ul>
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
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View citizens</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                System users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="SystemUsers.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage users <span class="badge badge-info float-right"><?php $users->System_user_count();?></span> </p>
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
  <!--section of registering users-->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <br>

    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

      <div class="card">
        <div class="card-header text-center bg-info"><i class="fa fa-address-card"></i>&nbsp;My information <a href="EditInfo.php?id=<?php echo $admin_id;?>&fname=<?php echo $fname;?>&lname=<?php echo $lname;?>&phone=<?php echo $phone;?>&email=<?php echo $email;?>&gender=<?php echo $gender;?>" class="float-left"><button class="btn btn-light"><i class="fa fa-edit"></i>&nbsp;Edit</button></a></div>
        <div class="card-body" style="overflow: auto;">

          <div class="row">
              <div class="col-md-6 text-center">
                  <img src="../style/dist/img/<?php echo $user_img;?>" class="img-circle elevation-2" alt="User Image" style="width:80px;height:80px;border-radius:50%;border:1px solid skyblue;">
              </div>

              <div class="col-sm-6">
                  <hr>

                  <div class="row">
                    <div class="col-md-12">
                      <span id="my_data"><p><b>Firstname :&nbsp;</b></p><p class="text-info"><b><?php echo $fname;?></b></p></span>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <span id="my_data"><p><b>Lastname :&nbsp;</b></p><p class="text-info"><b><?php echo $lname;?></b></p></span>
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
              <span id="my_data"><p><b>Birth date :&nbsp;</b></p><p class="text-info"><b><?php echo $dob;?></b></p></span>
            </div>
          </div>
        
        </div>
      </div>
      
      <!--end of card-->
    </div>
    <div class="col-md-2"></div>
  </div>

  <!--end of wrapper contents page-->
  </div>

<!-- jQuery -->
<script src="../style/plugins/jquery/jquery.min.js"></script>
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
