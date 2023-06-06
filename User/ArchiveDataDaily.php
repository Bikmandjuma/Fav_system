
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

require '../Connect/connection.php';
require '../phpcode/codes.php';

$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];
$date=$_REQUEST['dates'];

//call the card_id from RFID code when a card is taped on rfid device 
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);

if ($date == date('Y-m-d')) {
    $today_name=" of "."<b>Today</b>";
}elseif($date == date('Y-m-d',strtotime('Yesterday'))){
    $today_name=" of "."<b>Yesterday</b>";
}else{
    $today_name=" on "."<b>".$date."</b>";
}

$users=new fac;

//Send sms to everyone attend today
$MessageSent=$MessageNotSent=null;
if (isset($_POST['SendMessage'])) {
    $sms=$_POST['msg'];
        
    $month=$_REQUEST['month'];
    $year=$_REQUEST['year'];
    $date=$_REQUEST['dates'];

    $sql="SELECT MIN(a_id) as a_id,card_id,firstname,lastname,gender,phone,c_id,citizen_fk_id,attend_date,attend_time from attendance left join citizentb on citizentb.c_id=attendance.citizen_fk_id where attendance.year='$year' and attendance.month='$month' and attendance.attend_date='$date' group by citizen_fk_id";

    $query=mysqli_query($con,$sql);
    while ($row=mysqli_fetch_assoc($query)) {
        $fnames=$row['firstname'];
        $lnames=$row['lastname'];
        $phone=$row['phone'];

        //code of sms
        $senderName='+250785389000';
        $data=array(
                    "sender"=>$senderName,
                    "recipients"=>$phone,
                    "message"=>"Hello ".$fnames." ".$lnames." , ".$sms,
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
          $MessageNotSent='<script type="text/javascript">toastr.error("Message not sent !")</script>';
      }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Citizen attend today</title>
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
                      <a href="../Logout.php" class="btn btn-primary"><i class="fa fa-lock"></i>  Logout</a>
                      <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>  Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <!--end of logout modal-->

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
            <a href="#" class="nav-link active">
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
    <!-- Content Header (Page header) -->
    <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?php echo $MessageSent.$MessageNotSent;?>
                <div class="card">
                  <div class="card-header text-center bg-info"><span style="font-size:25px;"><span class="badge badge-light float-left" ><?php $users->count_citizen_attended_daily();?></span> Attendance <?php echo $today_name;?> !<button class="btn btn-light float-right" id="composer_msg_btn" title="Send a warning message to anyone who attended on <?php echo $date;?> !" data-toggle="modal" data-target="#msg_Modal"><i class="fa fa-envelope"></i>&nbsp;Compose</b></button></span></div>
                  <div class="card-body text-center" style="overflow: auto">
        
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr class="bg-info">
                          <th>Card_id</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Gender</th> 
                          <th>Phone</th>
                          <th>Attendance's&nbsp;time</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                          $users->Fetch_citizen_attend_daily();
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
                   <span class="float-center"><h2>Send them a warning message</h2></span><!--  <button type="button" class="close" data-dismiss="modal" style="font-size: 30px;color: white">&times;</button> -->
                 </div>
                 <div class="modal-body" style="overflow:auto;">
                   <form class="form-group" method="POST">
<!--                     <label><i class="fa fa-home"></i>&nbsp;Sitename</label>
                     <input type="text" name="subject" placeholder="Enter firstname" class="form-control" required disabled value="<?php //echo $_SESSION['sitename'];?>"><br> -->
                     <label><i class="fa fa-envelope"></i>&nbsp;Message</label>
                     
                     <textarea name="msg" rows="3" placeholder="Typing message . . . . . ." class="form-control" autofocus required></textarea><br>
                   
                     <button type="submit" class="btn btn-primary float-left" name="SendMessage">Send&nbsp;<i class="fa fa-paper-plane"></i></button>

                     <button type="reset" class="btn btn-danger float-right" class="close" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Close</button>

                   </form>
                 </div>
              </div>

             <!--end of Modal content-->
          

          </div>

        <!--Endmof message modal-->

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
