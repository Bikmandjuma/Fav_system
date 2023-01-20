<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="jquery.js"></script>
	<script src="jquery.min.js"></script>
</head>
<body>

<?php 
// Include the database config file 
include '../Connect/connection.php';

 
if(!empty($_POST["province_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM district WHERE province_id = ".$_POST['province_id']." AND status = 1 ORDER BY district_name ASC"; 
    $result = $con->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select . . .</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['district_id'].'">'.$row['district_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">District not available</option>'; 
    } 
}elseif(!empty($_POST["district_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM sector WHERE district_id = ".$_POST['district_id']." AND status = 1 ORDER BY sector_name ASC"; 
    $result = $con->query($query); 

        // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select . . .</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['sector_id'].'">'.$row['sector_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Sector not available</option>'; 
    } 

}elseif(!empty($_POST["sector_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM cell WHERE sector_id = ".$_POST['sector_id']." AND status = 1 ORDER BY cell_name ASC"; 
    $result = $con->query($query); 

        // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select . . . </option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['cell_id'].'">'.$row['cell_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Cell not available</option>'; 
    } 
  
  }elseif(!empty($_POST["cell_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM village WHERE cell_id = ".$_POST['cell_id']." AND status = 1 ORDER BY village_name ASC"; 
    $result = $con->query($query); 

        // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select . . . </option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['village_id'].'">'.$row['village_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Village not available</option>'; 
    } 
    
  }

?>

</body>
</html>