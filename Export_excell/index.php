<?php
require_once __DIR__ . '/lib/Post.php';
$post = new post();
$postResult = $post->getAllPost();
$columnResult = $post->getColumnName();
if (! empty($_GET["action"])) {
    require_once __DIR__ . '/lib/ExportService.php';
    $exportService = new ExportService();
    $result = $exportService->exportExcel($postResult, $columnResult);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./style.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="table-container">
        <table id="tab">
            <thead>
                <tr>
                    <th width="5%">Id</th>
                    <th width="35%">Name</th>
                    <th width="20%">Price</th>
                    <th width="25%">Category</th>
                    <th width="25%">product Image</th>
                    <th width="20%">Average Rating</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (! empty($postResult)) {
                foreach ($postResult as $key => $value) {
                    ?>
                <tr>
                    <td><?php echo $postResult[$key]["id"]; ?></td>
                    <td><?php echo $postResult[$key]["name"]; ?></td>
                    <td><?php echo $postResult[$key]["price"]; ?></td>
                    <td><?php echo $postResult[$key]["category"]; ?></td>
                    <td><?php echo $postResult[$key]["product_image"]; ?></td>
                    <td><?php echo $postResult[$key]["average_rating"]; ?></td>
                </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>
        <div class="btn">
            <form action="" method="POST">
                <a
                    href="<?php echo strtok($_SERVER["REQUEST_URI"]);?><?php echo $_SERVER["QUERY_STRING"];?>?action=export"><button
                        type="button" id="btnExport" name="Export"
                        value="Export to Excel" class="btn btn-info">Export
                        to Excel</button></a>
            </form>
        </div>
    </div>
</body>
</html>