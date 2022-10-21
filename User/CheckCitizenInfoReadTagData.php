
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
  
  $invalid_id_cards=$card_id=null;

  $sql="SELECT * from citizentb where card_id='".$id."'";
  $query=mysqli_query($con,$sql);
  while ($row=mysqli_fetch_assoc($query)) {
    $card_id=$row['card_id'];
    $fname=$row['firstname'];
    $midname=$row['middlename'];
    $lname=$row['lastname'];
    $gender=$row['gender'];
    $phone=$row['phone'];
    $province=$row['province'];
    $district=$row['district'];
    $sector=$row['sector'];
    $cellule=$row['cellule'];
    $village=$row['village'];
    $dob=$row['dob'];
    $registered_date=$row['registered_date'];
  }

  if ($card_id == $id) {
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

     $invalid_id_cards="<span class='text-light'><b>System not recognize ,this id card <span class='bg-light text-danger' style='padding:0px 5px 0px 5px;border-radius:10px;'>".$id."</b></span> !</span>";

   }


?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script src="../js/bootstrap.js"></script>
<body class="w3-light-grey">
<!-- Sidebar/menu -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_secs_close()" style="cursor:pointer" title="close side menu" id="secs_myOverlay"></div>
<!-- !PAGE CONTENT! -->
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 bg-info text-center" style="border-radius:5px;">
        <h3>Tap card to check citizen's information !</h3>
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
            <div class="card-header bg-info">
              <h2 class="text-white text-center">Information of <b> <?php echo $fname." ".$lname;?>!</b><a href="EditCitizenInfo.php?card_id=<?php echo $id;?>"><button class="btn btn-light float-right"><i class="fa fa-edit"></i> Edit</button></a></h2>
            </div>

            <div class="card-body">
              <div class="list-group">

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Card id</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $card_id;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Firstname  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $fname;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Lastname  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $lname;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row">
                    <div class="2"></div>
                    <div class="col-md-4 "><h2>Gender  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $gender;?></h2></div>
                    <div class="2"></div>
                  </div>
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Phone  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $phone;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Birth date</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $dob;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Province  </h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $province;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>District</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $district;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Sector</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $sector;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Cellule</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $cellule;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Village</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $village;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

                <div class="list-group-item">
                  <div class="row"> 
                    <div class="2"></div>
                    <div class="col-md-4"><h2>Joined date</h2></div>
                    <div class="col-md-4 text-primary"><h2><?php echo $registered_date;?></h2></div>
                    <div class="2"></div>
                  </div>  
                </div>

              </div>
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

</body>
</html>