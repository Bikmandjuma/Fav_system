
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

require '../phpcode/codes.php';
$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];

$Site_name=$_SESSION['sitename'];
$Entrance_name=$_SESSION['entrance'];
$Site_EntranceName=$Site_name.$Entrance_name;
//call the card_id from RFID code when a card is taped on rfid device 
$Write="<?php $" . "".$Site_EntranceName."=''; " . "echo $" . "".$Site_EntranceName.";" . " ?>";
file_put_contents('UIDContainer.php',$Write);

$users=new fac;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register citizen</title>
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
          <img src="../style/dist/img/<?php echo $user_img;?>" class="img-circle elevation-2" alt="User Image" style='border:1px solid white;'>
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
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Citizen
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="CheckCitizenInfo.php" class="nav-link">
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

    <?php
      
      $citizen_added=$error_citizen_add=$allfield_required=$star=$card_id=$firstname=$midname=$lastname=$gender=$phone=$province=$district=$sector=$cellule=$village=$village=$dob=$diplic_error=$diplic_error_phone=null;
      if (isset($_POST['submit_citizen_data'])) {
        include '../Connect/connection.php';
        
        try{
          $card_id=mysqli_real_escape_string($con,$_POST['card_id']);
          $firstname=mysqli_real_escape_string($con,$_POST['fname']);
          $midname=mysqli_real_escape_string($con,$_POST['midname']);
          $lastname=mysqli_real_escape_string($con,$_POST['lname']);
          $gender=mysqli_real_escape_string($con,$_POST['gender']);
          $phone=mysqli_real_escape_string($con,$_POST['phone']);
          $province=mysqli_real_escape_string($con,$_POST['province']);
          $district=mysqli_real_escape_string($con,$_POST['district']);
          $sector=mysqli_real_escape_string($con,$_POST['sector']);
          $cellule=mysqli_real_escape_string($con,$_POST['cellule']);
          $village=mysqli_real_escape_string($con,$_POST['village']);
          $dob=mysqli_real_escape_string($con,$_POST['dob']);
          $registered_date=mysqli_real_escape_string($con,date("y-m-d"));

          if (empty($card_id) || empty($firstname) || empty($midname) || empty($lastname) || empty($gender) || empty($phone) || empty($province) || empty($district) || empty($sector) || empty($cellule) || empty($village) || empty($dob)) {
            
              $allfield_required='
                        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                   All fields with <span style="font-size:25px;">(*)</span> are required!
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                        </div>
              ';

              $star="<span style='color:red;font-size:25px;'>*</span>";

          }else{

                $diplic_sql=mysqli_query($con,"SELECT * from citizentb where card_id='".$card_id."'");
                $diplic_nums=mysqli_num_rows($diplic_sql);

                if ($diplic_nums > 0) {
                    $diplic_error='
                              <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                       This id card <span style="font-size:20px;"><b>('.$card_id.')</b></span> is already registered !
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                              </div>
                    ';
                }else{
                    $diplic_sql_phone=mysqli_query($con,"SELECT * from citizentb where phone='".$phone."'");
                    $diplic_nums_phone=mysqli_num_rows($diplic_sql_phone);

                    if ($diplic_nums_phone > 0) {
                        $diplic_error_phone='
                                  <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                           This phone number <span style="font-size:20px;"><b>('.$phone.')</b></span> is already registered !
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                  </div>
                        ';

                    }else{
                        $sql="INSERT INTO  citizentb values ('','$card_id','$firstname','$midname','$lastname','$gender','$phone','$province','$district','$sector','$cellule','$village','$dob','$registered_date')";
                        $result=mysqli_query($con,$sql);
                        if ($result) {
                          echo "<script>window.location.assign('Register_Citizen.php')</script>";
                          $citizen_added='
                                  <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                               Citizen data added successfully !
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                          ';

                        }else{

                          $error_citizen_add='
                                  <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                                               Error to add Citizen data !
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                          ';

                        }
                    }

                }

          }
              
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }

      }

    ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:lightgrey;">
    <!-- Content Header (Page header) -->
    <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

            <?php echo $citizen_added.$error_citizen_add; ?>
            <div class="card">
              <div class="card-header text-center bg-info"><span style="font-size:20px;"><i class="fa fa-edit"></i>&nbsp; Register citizen</span></div>
              <div class="card-body" style="overflow: auto;">

                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <?php echo $allfield_required.$diplic_error.$diplic_error_phone;?>
                      </div>
                      <div class="col-md-2"></div>
                    </div>

                    <script>
                      $(document).ready(function(){
                         $("#getUID").load("UIDContainer.php");
                        setInterval(function() {
                          $("#getUID").load("UIDContainer.php");
                        }, 500);
                      });
                    </script>

                    <form class="form-group" method="POST" action="">
                         <div class="row">
                            <div class="col-md-4">
                              <label>Card id</label><?php echo $star;?>
                                <textarea name="card_id" id="getUID" placeholder="Please Scan your Card to display ID" rows="1" cols="1" class="form-control" autofocus value="<?php echo $card_id;?>"></textarea>    
                                <label>Firstname</label><?php echo $star;?>
                                <input type="text" name="fname" placeholder="Enter lastname" class="form-control" value="<?php echo $firstname;?>">

                                <label>Middle-name</label>
                                <input type="text" name="midname" placeholder="Enter middlename" class="form-control" value="<?php echo $midname;?>">

                                <label>Lastname</label><?php echo $star;?>
                                <input type="text" name="lname" placeholder="Enter lastname" class="form-control" value="<?php echo $lastname;?>">

                            </div>
                            <div class="col-md-4">
                                <label>Gender</label><?php echo $star;?>
                                <select name="gender" class="form-control" >
                                    <option value="">select gender </option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <label>Phone</label><?php echo $star;?>
                                <input type="text" name="phone" placeholder="Enter phone" class="form-control" value="<?php echo $phone;?>">
                                <label>Province</label><?php echo $star;?>
                                <input type="text" name="province" placeholder="Enter province" class="form-control" value="<?php echo $province;?>">

                                <label>District</label><?php echo $star;?>
                                <input type="text" name="district" placeholder="Enter district" class="form-control" value="<?php echo $district;?>">

                            </div>
                            <div class="col-md-4">
                              
                                <label>Sector</label><?php echo $star;?>
                                <input type="text" name="sector" placeholder="Enter sector" class="form-control" value="<?php echo $sector;?>">
                                <label>Cellule</label><?php echo $star;?>
                                <input type="text" name="cellule" placeholder="Enter cellule" class="form-control" value="<?php echo $cellule;?>">
                                <label>Village</label><?php echo $star;?>
                                <input type="text" name="village" placeholder="Enter village" class="form-control" value="<?php echo $village;?>">

                                <label>Birth date</label><?php echo $star;?>
                                <input type="date" name="dob" class="form-control" value="<?php echo $dob;?>">

                            </div>
                          </div>

                          <br>
                       
                         <div class="row">
                           <div class="col-md-12 text-center">
                             <button type="submit" class="btn btn-primary" name="submit_citizen_data"><i class="fa fa-save">&nbsp;</i>Register</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;Reset</button>
                           </div>
                         </div>
                         
                    </form>

              </div>
            </div>
            
            </div>
            <div class="col-md-1"></div>
        </div>

        <!-- Logout model -->
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
        <!--end of logout model-->

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
