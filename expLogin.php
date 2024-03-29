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

  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

  <!--custom css style-->
<!--   <link rel="stylesheet" href="style/dist/css/index.css">
 -->
 <style>
   body{
    background-image: url('style/dist/img/scard.png');
    background-repeat: no-repeat;
    background-position: center center;
   }

   ::-webkit-scrollbar{
    display: none;
   }

   #blink:hover{
    cursor: pointer;
   }
 </style>
</head>
<body>

<div class="row">
    <div class="col-md-12 text-center" style="background-color: teal;color: white">
        <h2 style="font-family: initial;">Fav system</h2>
    </div>
</div>

<br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

<!--           <?php //echo $incorectcredential?>
 -->
            <div class="row" style="margin-top:50px;"  id="blink">
              <div class="col-md-12 text-center">
                <span style="margin-left:10px;font-size: 20px;" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#SimpleModalBox"><i class="fa fa-lock"></i>&nbsp;<a href="#" style="color:black;font-family:serif;">Enter</a></span>
              </div>
            </div>

            <div class="modal fade" id="SimpleModalBox" tabindex="-1" role="dialog" aria-labelledby="SimpleModalLabel" aria-hidden="true">
              <!--<modal-dialog>-->
              <div class = "modal-dialog">

                <!--<modal-content>-->
                <div class = "modal-content">

                  <div class = "modal-header text-center">
                      <h4 class="modal-title" id="myModalLabel">Login here</h4>
                      <h4 class="modal-title" id="ForgotpswdTitle" style="display: none;">Forgot password</h4>
                  </div>


                  <div id="TheBodyContent" class = "modal-body">
        
                      <form id="loginform" name="myForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                        <div class="modal-body">

                          <label class="col-xs-2 col-form-label">Email</label>
                          <div class="input-group mb-3">
                            <input type="email" name="Username" class="form-control" placeholder="Enter email" id="EmailInput">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                            <div id="email"></div>
                          </div>

                          <label class="col-xs-2 col-form-label">Password</label>
                          <div class="input-group mb-3">
                            <input type="password" name="Password" id="AddPassword" class="form-control" placeholder="Enter password" id="PassInput">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-key"></span>
                              </div>
                            </div>
                            <div id="password"></div>
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

                  <div class = "modal-footer">
                    <button type = "button" class = "btn btn-danger" data-dismiss="modal">close</button>
                  </div>

                </div>
                <!--<modal-content>-->

              </div>
              <!--/modal-dialog>-->
            </div>
            <!--</SimpleModalBox>-->
              
                <script>

                  //#region Dialogs
                  function showSimpleDialog() {
                    $( "#SimpleModalBox" ).modal();
                  }

                  function doSomethingBeforeClosing() {
                    //Do something. For example, display a result:
                    $( "#TheBodyContent" ).text( "Operation completed successfully" );

                    //Close dialog in 3 seconds:
                    setTimeout( function() { $( "#SimpleModalBox" ).modal( "hide" ) }, 3000 );
                  }

                  function myFunction(){
                    var email=document.forms['myForm']['Username'].value;
                    var pass=document.forms['myForm']['Password'].value;
                    if (email == "" || pass == "") {
                      document.getElementById('alertmsg').style.display="block";
                      return false;
                    }
                  }

                </script>

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

          // $('#SimpleModalBox').submit( function (e ) {
          //     e.preventDefault();
          //         var data = $(this).serialize();
          //         $.ajax({
          //         method: 'POST',
          //         url: '/',
          //         data: data,
          //         headers: {'Content-Type': 'application/x-www-form-urlencoded'}
          //     })
          //     .success(function(data) {
          //         console.log('success', data);
          //     })
          //     .error(function(data) {
          //         console.log('error', data);
          //     });
          //   });
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
