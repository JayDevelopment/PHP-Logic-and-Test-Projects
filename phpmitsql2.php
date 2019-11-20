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
$article_number = sanatize_data($_GET['article_number']);
$article_search = sanatize_data($_GET['article_search']);
$sql = "SELECT V300010, V580010, V300850N, V30BEZ, V3003_005, V710040N, STOCK
        FROM data.V30DE
        INNER JOIN data.V58DE ON V30DE.V300060=V58DE.V580030 AND V580040=1
        WHERE V300010 = '{$article_number}'";
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
    echo "<th>V300010</th><th>V580010</th><th>V300850N</th><th>V30BEZ</th><th>V3003_005</th>
          <th>V710040N</th><th>STOCK</th>";
    while($row=result_db1($query)) {
        echo "<tr>";
              for($j=0; $j<7;$j++) {
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