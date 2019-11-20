<?php 
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
include_once '/var/www/libs/db.php';
function sanatize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 
$device_number = sanatize_data($_GET['device_number']);
$device_search = sanatize_data($_GET['device_search']);
$sql = "SELECT Articles.article_id, article_name, article_price
        FROM testmerrill.Articles 
        INNER JOIN testmerrill.Device_Article_Connection ON Device_Article_Connection.article_id=Articles.article_id
        WHERE device_id = '{$device_number}'";
$query = query_db1($sql);
?>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<?php
if (mysqli_num_rows($query) > 0) {
    echo "<div style='overflow-x:auto'>";
    echo "<table cellspacing='1' cellpadding='3' border='1' id= 'more-info'>";
    echo "<th>Article Number</th><th>Article Name</th><th>Article price</th>";
    while($row=result_db1($query)) {
        echo "<tr>";
              for($j=0; $j<3;$j++) {
                echo "<td><a href='#'>".$row[$j]."</a></td>";
              }
        echo "</tr>";
    }
    //var_dump($query);
    echo "</table></div>";
}
//mysqli_free_result($result);
//mysqli_close($conn);
?>
</body>
</html>