<style type="text/css">
    .image-gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .image-gallery > li {
      height: 300px;
      list-style-type:none;
      cursor: pointer;
      position: relative;
    }

    .image-gallery li img {
      object-fit: cover;
      width: 100%;
      height: 100%;
      vertical-align: middle;
      border-radius: 5px;
    }
    .image-gallery::after {
      content: "";
      flex-basis: 350px;
    }

    .image-gallery > li {
      /* ... */
      flex-grow: 1;
      position: relative;
      cursor: pointer;
    }
        
    .overlay {
      position: absolute;
      width: 100%;
      height: 100%;
      background: rgba(57, 57, 57, 0.502);
      top: 0;
      left: 0;
      transform: scale(0);
      transition: all 0.2s 0.1s ease-in-out;
      color: #fff;
      border-radius: 5px;
      /* center overlay text */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* hover */
    .image-gallery li:hover .overlay {
      transform: scale(1);
    }
  </style>
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../index.php');
}

require '../Connect/connection.php';

$fname=$_SESSION['firstname'];
$lname=$_SESSION['lastname'];
$user_img=$_SESSION['image'];

//call the card_id from RFID code when a card is taped on rfid device 
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);
  
  $id = null;
  
  if ( !empty($_GET['id'])) {
      $id =$_REQUEST['id'];
  }
  
  $invalid_id_cards=$card_id=$confirm=null;

  $sql="SELECT * from citizentb where card_id='".$id."'";
  $query=mysqli_query($con,$sql);
  while ($row=mysqli_fetch_assoc($query)) {
    $citiz_id=$row['c_id'];
    $card_id=$row['card_id'];
    $fname=$row['firstname'];
    $lname=$row['lastname'];
    
  }

  if ($card_id == $id) {
    date_default_timezone_set("Africa/Kigali");
    $time=date("h:i:s a");
    $date=date("Y-m-d");
    $month=date("m");
    $year=date("Y");
    $atn_sql=mysqli_query($con,"INSERT INTO attendance values ('','$citiz_id','$date','$time','$year','$month')");

    if ($atn_sql == true) {
       $today=date("Y-m-d");
       $sql_attend_times="SELECT * from citizentb inner join attendance on citizentb.c_id=attendance.citizen_fk_id where citizentb.card_id='".$id."' and attendance.attend_date='".$today."' ";
       $query_attend_times=mysqli_query($con,$sql_attend_times);
       $num_attend_times=mysqli_num_rows($query_attend_times);

       while ($row=mysqli_fetch_assoc($query_attend_times)) {
          $sex=$row['gender'];
       }

       if ($sex == 'male') {
          $gender="he's";
       }else{
          $gender="she's";
       }

       

       if ($num_attend_times == 1) {
          $times='attending';
       }else{
          $times='attending&nbsp;,&nbsp;x'.$num_attend_times;
       }
      
      $confirm="<span style='color:lightgrey;'>".$fname." ".$lname."</span> ".$gender." ".$times;
    }

     ?>
      <style>
        #HideTitle{
          display: none;
        }

        #ShowsTitle{
          display: block;
        }

        #error_card_id{
            display:none; 
        }


      </style>
     <?php
   }elseif ($card_id != $id) {
      
      ?>
      <style>
        #ShowsTitle{
          display:none;
        }

        #CitizenInfoDiv{
         display:none; 
        }

        #error_card_id{
            display:block; 
        }

      </style>
      <?php

      $invalid_id_cards="<span class='text-light'><b>System not recognize , this id card <span class='bg-light' style='padding:0px 5px 0px 5px;border-radius:10px;color:red;'>".$id."</span> !</b></span>";

   }


?>

<!-- Sidebar/menu -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_secs_close()" style="cursor:pointer" title="close side menu" id="secs_myOverlay"></div>
<!-- !PAGE CONTENT! -->
      <div class="row" id="blinks">
          <div class="col-md-2"></div>
          <div class="col-md-8 bg-info text-center" style="border-radius:5px;">
            <h3><b>Tap card to make attendance</b></h3>
          </div>
          <div class="col-md-2"></div>
      </div>

   <br>

  <div class="row" id="ShowsTitle">
    <div class="col-md-12">
    </div>
  </div>
      
  <div class="row">
    <div class="col-md-12 ">

      <div class="row" id="CitizenInfoDiv">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card">
            <div class="card-header bg-info text-center">
              <h2 class="text-white"><b><?php echo $confirm;?> !</b></h2>
            </div>

            <div class="card-body" style="overflow:auto;">
              <img src="../style/dist/img/smart-cards-og.jpg" style="margin-top:-20px;" class="image-gallery" width="720">
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>

    </div>
  </div>
  

  <!-- End page content -->
    <div class="row">
      <div class="col-md-12" id="error_card_id">

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">

            <div class="card">
              <div class="card-header text-center bg-danger"><span style="font-size:25px;"><h3><?php echo $invalid_id_cards;?></h3></span></div>
              <div class="card-body text-center" style="overflow: auto">
                <img src="../images/NoSearch.jpg">
              </div>
            </div>
            
            </div>
            <div class="col-md-1"></div>
        </div>

      </div>
    </div>
