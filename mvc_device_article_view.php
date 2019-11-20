<?php 
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
require "mvc_device_search_model.php";
require "mvc_article_controller.php";
$model = new Model();
$db = $model->getConnection();
$articles = new Articles($db);
$articles->number = (isset($_GET['device_number'])) ? $_GET['device_number'] : '';
?>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<?php
$stmt = $articles->viewDeviceConnections();
echo "<table id = 'more-info'>";
    echo "<th>Article Number</th><th>Article Name</th><th>Article price</th>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "
        <tr>
        <td><a href='#'>{$row["article_id"]}</a></td>
        <td><a href='#'>{$row['article_name']}</a></td>
        <td><a href='#'>{$row['article_price']}</a></td>
        </tr>";
    }
echo "</table>";
?>
</body>
</html>