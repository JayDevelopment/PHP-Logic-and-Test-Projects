<?php 
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
include_once '/var/www/libs/db.php';
$article_number = sanatize_data($_GET['article_number']);
$article_search = sanatize_data($_GET['article_search']);
$active_articles = (isset($_GET['active_articles']))
? "AND V3002_011 = 1"
    : '';
    $in_stock = (isset($_GET['in_stock']))
    ? "AND STOCK <> 0"
        : '';
        function sanatize_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function validate($article_number, $article_search) {
            if(isset($article_number) && $article_number != '' && empty($article_search)) {
                echo "<p class = 'error'>The article number {$article_number} is invalid or not available under the checked conditions</p>";
            } elseif(isset($article_search) && $article_search != '' && empty($article_number)) {
                echo "<p class = 'error'>For the term {$article_search} there were no matches under the requested conditions</p>";
            } else {
                check_string_length($article_search);
            }
            //echo $error_message;
        }
        function died(){
         echo "<br><p class = 'error'>Please fill in either the article number OR article search field</p>";
         die();
         } 
        function check_string_length ($string) {
            if(strlen($string) < 3) {
                $error_css = 'error';
                echo "<p class ='error'>Not enough characters</p>";
                die();
            }
        }
if($_SERVER["REQUEST_METHOD"] == "GET" && empty($_GET['article_search'])) {
    $sql = "SELECT V300010, V580010
            FROM data.V30DE 
            INNER JOIN data.V58DE ON V30DE.V300060=V58DE.V580030 AND V580040=1 {$active_articles} {$in_stock}
            WHERE V300010 = '{$article_number}'";
    //echo $sql;
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && empty($_GET['article_number'])) {
    check_string_length ($article_search);
    $sql = "SELECT V300010, V580010
            FROM data.V30DE 
            INNER JOIN data.V58DE ON V30DE.V300060=V58DE.V580030 AND V580040=1 {$active_articles} {$in_stock}
            WHERE V308080 LIKE '{$article_search}%' OR V308090 LIKE '{$article_search}%'";
    //echo $sql;
} else {
    died();
    //$sql = "SELECT V300010, V580010 FROM data.V30DE INNER JOIN data.V58DE ON V30DE.V300060=V58DE.V580030 AND V580040=1 LIMIT 10";
} 
if (isset($_GET)) {
$query = query_db1($sql);
}
$rows = array();
if (mysqli_num_rows($query) > 0) {
    while($row=result_db1($query)) {
        $subArray[V300010]=$row['V300010'];
        $subArray[V580010]=$row['V580010'];
        $rows[] = $subArray;
    }
    print json_encode($rows);
} else {
    validate($article_number, $article_search);
} 

/*
if (mysqli_num_rows($query) > 0) {
    echo "<div style='overflow-x:auto'>";
    echo "<table cellspacing='1' cellpadding='3' border='1'>";
    echo "<th>V300010</th><th>V580010</th><th>Picture</th>";
    while($row=result_db1($query)) {
        echo "<tr><td><a href='phpmitsql2.php?article_number={$row["V300010"]}&article_search=$article_search' target='_blank'>{$row["V300010"]}</a></td><td>{$row["V580010"]}</td><td><img src='/jmerrill/images/{$row["V300010"]}.jpg'></td></tr>";
    }
    echo "</table></div>";
    
} */


//mysqli_free_result($result);

//mysqli_close($conn);
?>