<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}
include_once '..\Connect\connection.php';
$auth_user_id=$_SESSION['id'];

$sql_user_info="SELECT * FROM admin where id=".$auth_user_id."";
$query_user_info=mysqli_query($con,$sql_user_info);
while ($row_user_info=mysqli_fetch_assoc($query_user_info)) {
  $fname=$row_user_info['firstname'];
  $lname=$row_user_info['lastname'];
}

$ErrorToAddUser=$UserAddedWell=null;
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

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  
  <style type="text/css">
    #card{
      background-repeat: no-repeat;
    }
    #online_icon{
      width:20px;
      height: 20px;
      background-color:red;
      border-radius:50px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#eee;">
<div class="wrapper">
  <?php include_once 'LogoutModel.php';?>
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
        <i class="fa fa-lock"></i>&nbsp;<a style="color: black;font-family: initial;" href="../Logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
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
            <a href="#" class="nav-link active">
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
            <a href="#" class="nav-link">
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
  <div class="content-wrapper" style="background-color:lightgrey;">
    <br>
    <?php
        echo $ErrorToAddUser.$UserAddedWell;
    ?>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

      <div class="card">
        <div class="card-header text-center bg-info">System users info <span class="badge badge-light float-left" style="font-size:20px;"><?php $users->System_user_count();?></span><button class="btn btn-light float-right" data-toggle="modal" data-target="#Add_new_user_Modal" data-backdrop="static" data-keyboard="false"><i class="ion ion-person-add"></i>&nbsp;Add user</button></div>
        <div class="card-body" style="overflow: auto;">
          <table class="table table-striped table-bordered text-center">
            <tr>
              <thead class="bg-info">
                <td>Image</td>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Gender</td>
                <td colspan="2">Action</td>
              </thead>
            </tr>

            <tbody>
                <?php
                    // $users->Select_user();
                    $fname=$lname=$gender=$phone=$email=$image=null;
                    $result=mysqli_query($con,"SELECT * FROM users");
                    while ($row=mysqli_fetch_assoc($result)) {
                      $fname=$row['firstname'];
                        $lname=$row['lastname'];    
                        $gender=$row['gender'];   
                        // $sitename=$row['sitename'];
                        $image=$row['image'];
                        
                        echo "
                          <tr>
                        <td>"."<img src='../style/dist/img/".$image."'' style='width:50px;height:50px;border-radius:50%;border:1px solid gray;'><span id='online_icon'></span>"."</td>
                        <td>".$fname."</td>
                        <td>".$lname."</td>
                        <td>".$gender."</td>
                              <td><a href='?id=".$row['u_id']."' onclick='getidfn()'><i class='fa fa-eye text-info'></i></a></td>
                              <td><a href='#Edit'><i class='fa fa-edit text-primary'></i></a></td>
                              </tr>
                        ";

                    }

                    if ($fname==null and $fname==null and $phone==null and $email==null) {
                        echo "<td colspan='6'>No users data found !</td>";
                      
                    }

                ?>
            </tbody>
            
          </table>
          <script>
            function getidfn(){
                alert('this element is clicked !');
            }
          </script>

            <!--Add new task model-->
            <div class="modal fade" id="Add_new_user_Modal" role="dialog">
             <div class="modal-dialog">
                          
               <!-- Modal content-->
               <div class="modal-content">
                 <div class="modal-header bg-info">
                   <span><h2>Add new user</h2></span> <button type="button" class="close" data-dismiss="modal" style="font-size: 30px;color: white">&times;</button>
                 </div>
                 <div class="modal-body" style="overflow:auto;">
                   <form class="form-group" method="POST" action="">
                      <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="fname" placeholder="Enter firstname" class="form-control" required>                          
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lname" placeholder="Enter lastname" class="form-control" required>
                        </div>
                      </div>
                      <br>
                      
                      <div class="row">
                        <div class="col-md-6">
                            <select name="gender" class="form-control" >
                              <option>select gender </option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" placeholder="Enter phone" class="form-control" required>
                        </div>
                      </div>

                      <br>
                      <div class="row">
                        <div class="col-md-6">
                            <input type="email" name="email" placeholder="Enter email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                          <input type="date" name="dob" class="form-control" required>
                        </div>
                      </div>

                      <br>

                      <div class="row">
                        <div class="col-md-6">
                            <!-- <select name="sitename" class="form-control" required>
                              <option>Select sitename . . .</option>
                               <?php 
                                  $result=mysqli_query($con,"SELECT * FROM users");
                                  while ($row=mysqli_fetch_assoc($result)) {
                                    ?>
                                      <!-- <option value="<?php echo $row['id'];?>"><?php echo $row['sitename']." ".$row['entrance'];?></option> -->

                                    <?php
                                  }
                               ?>
                            </select> 
                        </div>
                        <div class="col-md-12 text-center">
                          <button type="submit" class="btn btn-primary float-center" name="submit">Add</button>&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </div>
        
                   </form>
                 </div>
              </div>

             <!--end of Modal content-->
          </div>
        </div>

        </div>
      </div>
      
      <!--end of card-->
    </div>
    <div class="col-md-2"></div>
    </div>

      <!--end of Add new task model-->
        
  <!--End of wrapper content page-->
  </div>

  <script>
      function useridfn(str){
        
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("show_user_data").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET","SystemUsers.php?id="+str,true);
          xmlhttp.send();
    
      }
  </script>
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
