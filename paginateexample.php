<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<title>Ajax Pagination with Tabular Records using PHP and jQuery</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <div id="container">
        <div id="inner-container">

            <div id="results"></div>
            <div id="loader"></div>

        </div>
    </div>

    <?php
require_once ("db.php");

if (! (isset($_GET['pageNumber']))) {
    $pageNumber = 1;
} else {
    $pageNumber = $_GET['pageNumber'];
}

$perPageCount = 5;

$sql = "SELECT * FROM tbl_staff  WHERE 1";

if ($result = mysqli_query($conn, $sql)) {
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
}

$pagesCount = ceil($rowCount / $perPageCount);

$lowerLimit = ($pageNumber - 1) * $perPageCount;

$sqlQuery = " SELECT * FROM tbl_staff WHERE 1 limit " . ($lowerLimit) . " ,  " . ($perPageCount) . " ";
$results = mysqli_query($conn, $sqlQuery);

?>

<table class="table table-hover table-responsive">
    <tr>
        <th align="center">Name</th>
        <th align="center">Experience<br>(in years)
        </th>
        <th align="center">Subject</th>
    </tr>
    <?php foreach ($results as $data) { ?>
    <tr>
        <td align="left">
            <?php echo $data['name'] ?>
        </td>
        <td align="left">
            <?php echo $data['experience'] ?>
        </td>
        <td align="left">
            <?php echo $data['major'] ?>
        </td>
    </tr>
    <?php
    }
    ?>
</table>

<div style="height: 30px;"></div>
<table width="50%" align="center">
    <tr>

        <td valign="top" align="left"></td>


        <td valign="top" align="center">
            <?php
	for ($i = 1; $i <= $pagesCount; $i ++) {
    if ($i == $pageNumber) {
        ?> <a href="javascript:void(0);" class="current">
                <?php echo $i ?>
        </a> <?php
    } else {
        ?> <a href="javascript:void(0);" class="pages"
            onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>');">
                <?php echo $i ?>
        </a> <?php
    } // endIf
} // endFor

?>
        </td>
        <td align="right" valign="top">Page <?php echo $pageNumber; ?>
            of <?php echo $pagesCount; ?>
        </td>
    </tr>
</table>

</body>
</html>

<script type="text/javascript">
    function showRecords(perPageCount, pageNumber) {
        $.ajax({
            type: "GET",
            url: "getPageData.php",
            data: "pageNumber=" + pageNumber,
            cache: false,
    		beforeSend: function() {
                $('#loader').html('<img src="loader.png" alt="reload" width="20" height="20" style="margin-top:10px;">');
    			
            },
            success: function(html) {
                $("#results").html(html);
                $('#loader').html(''); 
            }
        });
    }
    
    $(document).ready(function() {
        showRecords(10, 1);
    });
</script>