<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];
require '../Connect/connection.php';
require '..\phpcode\codes.php';
$users=new fac;

$user_id=$_SESSION['id'];

$image_uploaded=$image_size=$image_type=$image_not_uploaded=$Error_to_uploaded=$File_not_image=null;
if (isset($_POST['SubmitProfilePicture'])) {
  
    $target_dir = "../style/dist/img/";
    $file_name=date('YmdHi').basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir .$file_name;
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

    if ($uploadOk = 1) {
        
        if($check !== false) {
              // Check file size
              if ($_FILES["fileToUpload"]["size"] > 5000000) {
                  $image_size='<script type="text/javascript">toastr.error("Sorry, your file is too large ,add 5MB at least.")</script>';
                  $uploadOk = 0;
              }

              // Allow certain file formats
              if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif" ) {
                 $image_type='<script type="text/javascript">toastr.error("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
                  $uploadOk = 0;
              }

              if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                  $u_sql="UPDATE admin set image='$file_name' where id='$user_id' ";
                  $u_query=mysqli_query($con,$u_sql);
                  $image_uploaded='<script type="text/javascript">toastr.success("Image added well !")</script>';
              } else {
                 $image_not_uploaded='<script type="text/javascript">toastr.error("Sorry, there was an error uploading your file !")</script>';
              }
        }


      }elseif ($uploadOk = 0) {
          $Error_to_uploaded='<script type="text/javascript">toastr.error("Sorry, your file was not uploaded")</script>';
      }
      

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_SESSION['lastname'];?> Profile</title>
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

      .card_profile{
      justify-content: center;
    }

    .card_title{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 70%; 
        text-align: center;
        background-color: white;
        border-radius:10px;
    }

    .card_title h3{
        font-family: serif;
    }
    
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 70%;
        border-radius:5px;
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
      <span class="brand-text font-weight-light">Fac system</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../style/dist/img/<?php $users->Admin_Profile_Picture();?>" class="img-circle elevation-2" alt="User Image">
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
              <i class="nav-icon fas fa-home"></i>
              <p>
                Sites
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="sites.php" class="nav-link">
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
                Citizens
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="CitizenInfo.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Citizens info</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="TodayAttendance.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Today's attendance</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="Archive.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Archive</p>
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
                  <p>Manage users <span class="badge badge-info float-right"><?php $users->System_user_count();?></span></p>
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
  <div class="content-wrapper" style="background-color:lightgrey;">
   <!--  <div class="row">
          <div class="col-lg-4 col-6"></div>
          <div class="col-lg-4 col-6"> -->
            <!--Start of image-->
              <!-- Content Wrapper. Contains page content -->
<!--               <div class="content-wrapper" style="background-color:lightgrey;">
 -->                <!-- Content Header (Page header) -->
                <?php echo $image_uploaded.$image_size.$image_type.$image_not_uploaded.$Error_to_uploaded.$File_not_image;?>
                <br>

                <?php
                  $user_img_sql="SELECT * FROM admin where image='user.png' and id=".$_SESSION['id']."";
                  $user_img_query=mysqli_query($con,$user_img_sql);
                  $img_number=mysqli_num_rows($user_img_query);
                 
                ?>
                    
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="col-md-4">

                      <div class="card_profile">

                        <div class="card_title">
                          <h3>Profile picture</h3>
                        </div>
                        
                        <div class="card">
                          <img src="../style/dist/img/<?php echo $users->Admin_Profile_Picture();?>">
                          <div class="container">
                            <h4><b><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></b></h4> 
                            <?php
                              if ($img_number == 1) {
                                ?>
                                  <button class="btn btn-info" data-toggle="modal" data-target="#ProfileModal"><i class="fa fa-image"></i>&nbsp;Add</button>
                                <?php
                              }else{
                                ?>
                                  <button class="btn btn-info" data-toggle="modal" data-target="#ProfileModal"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                <?php
                              }
                            ?>
                            
                          </div>
                        </div>

                      </div>


                      </div>
                      <div class="col-md-4"></div>
                  </div>

                   <!--start of Logout modal -->
                      <div class="modal" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-body text-left">
                              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4>Logout&nbsp;<i class="fa fa-lock"></i></h4>
                            </div>
                            <div class="modal-body">
                              <p><i class="fa fa-question-circle"></i>Are you sure , you want to log-off ? <br /></p>
                              <div class="actionsBtns">
                                  <input type="hidden" name="${_csrf.parameterName}" value="${_csrf.token}"/>
                                  <a href="../Logout.php" class="btn btn-primary">Logout</a>
                                  <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--end of logout modal-->

                    <!--start of Profile modal -->
                      <div class="modal" id="ProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm text-center">
                          <div class="modal-content">
                            <div class="modal-body">
                              <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              <h4><i class="fa fa-image"></i>&nbsp;Profile picture</h4>
                            </div>
                            <div class="modal-body">
                              <div class="actionsBtns">
                                <form enctype="multipart/form-data" method="POST">
                                  <!-- <div class="row">
                                    <div class="col-md-6"> -->
                                      <img id="blah" style="width:130px;height:150px;" src="../style/dist/img/<?php echo $users->Admin_Profile_Picture();?>" /><br>
                                    <!-- </div>
                                    <div class="col-md-6">
             -->                          
                                      <br>
                                      <input name="fileToUpload" type="file" accept="image/*" id="imgInp" class="form-control" required><br>
                                      <button class="btn btn-primary" type="submit" name="SubmitProfilePicture"><i class="fa fa-save"></i> Save change</button>
                                   <!--  </div>
                                  </div> -->
                                  
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!--end of profile modal-->

              <!--End of wrapper content page-->
              </div>

              <script type="text/javascript">
                imgInp.onchange = evt => {
                  const [file] = imgInp.files
                  if (file) {
                    blah.src = URL.createObjectURL(file)
                  }
                }
            </script>

            <!--End of profile-->
         <!--  </div>
          <div class="col-lg-4 col-6"></div>
    </div> -->
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
