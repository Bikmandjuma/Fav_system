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

require '..\phpcode\codes.php';
$users=new fac;

//Send sms to everyone attend today
$MessageSent=$MessageNotSent=null;
if (isset($_POST['SendMessage'])) {
    $sms=$_POST['msg'];
    date_default_timezone_set("Africa/Kigali");
    $today=date("Y-m-d");
        
    $sql="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.attend_date='$today' group by citizen_fk_id";

    $query=mysqli_query($con,$sql);
    while ($row=mysqli_fetch_assoc($query)) {
        $fnames=$row['firstname'];
        $lnames=$row['lastname'];
        $phone=$row['phone'];
        $attend=$row['attend_time'];

        //code of sms
        $senderName='+250785389000';
        $data=array(
                    "sender"=>$senderName,
                    "recipients"=>$phone,
                    "message"=>"Muraho ".$fnames." ".$lnames." ububutumwa buvuye ".$sms,
              );

          $url="https://www.intouchsms.co.rw/api/sendsms/.json";
          $data=http_build_query($data);
          $username="IndexZero";
          $password="bugarama123@";

          $ch=curl_init();
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
          curl_setopt($ch,CURLOPT_POST,true);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
          $result=curl_exec($ch);
          $httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
          curl_close($ch);
    }

      if ($result == true) {
          $MessageSent='<script type="text/javascript">toastr.success("Message sent successfully !")</script>';
      }else{
          $MessageNotSent='<script type="text/javascript">toastr.error("Message not sent ,check your network and try again !")</script>';
      }

}
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

    ::-webkit-scrollbar{
      display: none;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
            <a href="home.php" class="nav-link active">
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:lightgrey;">

    <br>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10">
        
        <?php echo $MessageSent.$MessageNotSent;?>
                <div class="card">
                  <div class="card-header text-center bg-info"><span style="font-size:25px;"><span class="badge badge-light float-left" ><?php $users->all_citizen_attend_today_nums();?></span> Citizens attends <b>today</b> !<button class="btn btn-light float-right" id="composer_msg_btn" title="Send a warning message to anyone who attended today !" data-toggle="modal" data-target="#msg_Modal"><i class="fa fa-paper-plane"></i>&nbsp;Compose a warning message</button> </span></div>
                  <div class="card-body text-center" style="overflow: auto">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-info">
                          <th>Card_id</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Gender</th> 
                          <th>Phone</th>
                          <th>Times</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                          $users->Fetch_citizen_attend_today();
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

      <div class="col-md-1"></div>
    </div>

            <!--Message modal-->
        <!--Add new task model-->
            <div class="modal fade" id="msg_Modal" role="dialog">
              <div class="modal-dialog">
                          
               <!-- Modal content-->
               <div class="modal-content">
                 <div class="modal-header bg-info">
                   <span class="float-center"><h2>Write a warning message here</h2></span>
                 </div>
                 <div class="modal-body" style="overflow:auto;">
                   <form class="form-group" method="POST">
<!--                     <label><i class="fa fa-home"></i>&nbsp;Sitename</label>
                     <input type="text" name="SiteName" placeholder="Enter firstname" class="form-control" required disabled value=""><br> -->
                     <label><i class="fa fa-envelope"></i>&nbsp;Message</label>
                     
                     <textarea name="msg" rows="3" placeholder="Muraho niyonkuru elyse ububutumwa buvuye nyabugogo ...." class="form-control" autofocus required></textarea><br>
                   
                     <button type="submit" class="btn btn-primary float-left" name="SendMessage">Send&nbsp;<i class="fa fa-paper-plane"></i></button>

                     <button type="reset" class="btn btn-danger float-right" class="close" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>

                   </form>
                  </div>
                 </div>

               <!--end of Modal content-->
          
                </div>
              </div>

        <!--Endmof message modal-->

    

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
