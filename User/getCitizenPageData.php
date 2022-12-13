<?php
require "../Connect/connection.php";

if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount =30;

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
        <?php $count=1; foreach ($results as $data) { ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $data['card_id'] ?></td>
            <td><?php echo $data['firstname'] ?></td>
            <td><?php echo $data['middlename'] ?></td>
            <td><?php echo $data['lastname'] ?></td>
            <td><?php echo $data['gender'] ?></td>
            <td><?php echo $data['phone'] ?></td>
            <td><?php echo $data['province'] ?></td>
            <td><?php echo $data['district'] ?></td>
            <td><?php echo $data['sector'] ?></td>
            <td><?php echo $data['cellule'] ?></td>
            <td><?php echo $data['village'] ?></td>
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