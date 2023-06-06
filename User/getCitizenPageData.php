<?php
require "../Connect/connection.php";

if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount =5;

$sql = "SELECT * FROM citizentb  WHERE 1";

if ($result = mysqli_query($con, $sql)) {
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
}

$pagesCount = ceil($rowCount / $perPageCount);

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$sqlQuery = " SELECT * FROM citizentb WHERE 1 limit " . ($lowerLimit) . " ,  " . ($perPageCount) . " ";
$results = mysqli_query($con, $sqlQuery);

?>
<div class="card-body" id="card">
    <table class="table table-bordered table-striped">
        <tr class="bg-info">
            <th>N<sup>o</sup></th>
            <th>Card_id</th>
            <th>Firstname</th>
            <th>Middlename</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Province</th>
            <th>District</th>
            <th>Sector</th>
            <th>Cellule</th>
            <th>Village</th>
            <th>Date&nbsp;of&nbsp;birth&nbsp;(DoB)</th>
            <th>Registered&nbsp;date</th>
        </tr>
        <?php $count=1; foreach ($results as $data) { 

            //province
            $prov=mysqli_query($con,"SELECT * FROM province where province_id=1");
            while ($row_prov=mysqli_fetch_assoc($prov)) {
                $province=$row_prov['province_name'];
            }

            //district
            $distrcit=mysqli_query($con,"SELECT * FROM district where district_id=1");
            while ($row_dist=mysqli_fetch_assoc($distrcit)) {
                $district=$row_dist['district_name'];
            }

            //sector
            $sect=mysqli_query($con,"SELECT * FROM sector where sector_id=1");
            while ($row_sect=mysqli_fetch_assoc($sect)) {
                $sector=$row_sect['sector_name'];
            }

            //province
            $cell=mysqli_query($con,"SELECT * FROM cell where cell_id=1");
            while ($row_cell=mysqli_fetch_assoc($cell)) {
                $cellule=$row_cell['cell_name'];
            }

            //province
            $vill=mysqli_query($con,"SELECT * FROM village where village_id=1");
            while ($row_vill=mysqli_fetch_assoc($vill)) {
                $village=$row_vill['village_name'];
            }
        ?>
        <tr>
            <td><?php echo $data['c_id'];?></td>
            <td><?php echo $data['card_id'] ?></td>
            <td><?php echo $data['firstname'] ?></td>
            <td><?php echo $data['middlename'] ?></td>
            <td><?php echo $data['lastname'] ?></td>
            <td><?php echo $data['gender'] ?></td>
            <td><?php echo $data['phone'] ?></td>
            <td><?php echo $province;?></td>
            <td><?php echo $district;?></td>
            <td><?php echo $sector;?></td>
            <td><?php echo $cellule;?></td>
            <td><?php echo $village;?></td>
            <td><?php echo $data['dob'] ?></td>
            <td><?php echo $data['registered_date'] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

<div class="card-body" id="card">
    <ul id="pages">
        <li>
    	<?php
    	for ($i = 1; $i <= $pagesCount; $i ++) {
        if ($i == $pageNumber) {
            ?>
    	      <a href="javascript:void(0);" class="current"><?php echo $i ?></a>
    <?php
        } else {
            ?>
    	      <a href="javascript:void(0);" class="pages"
                onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>');"><?php echo $i ?></a>
    <?php
        } // endIf
    } // endFor

    ?>
        </li>
        <br>
        <li style="text-align:center;">
    	   Page <span class="text-info"><b><?php echo $pageNumber; ?></b></span> of <span class="text-info"><b><?php echo $pagesCount; ?></b></span>
        </li>
    
    </ul>
</div>