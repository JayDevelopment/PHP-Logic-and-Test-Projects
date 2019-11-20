<?php 
require_once 'php_model.php';
$device_number = sanatize_data($_GET['device_number']);
$device_search = sanatize_data($_GET['device_search']);
$error_css =  (strlen($_GET['device_search']) >= 3 ? "class='device_search'" : "class='red'");

        function sanatize_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function validate($device_number, $device_search) {
            if(isset($device_number) && $device_number != '' && empty($device_search)) {
                echo "<p class = 'error'>The device number {$device_number} is invalid or not available under the checked conditions</p>";
                die();
            } elseif(isset($device_search) && $device_search != '' && empty($device_number)) {
                echo "<p class = 'error'>For the term {$device_search} there were no matches under the requested conditions</p>";
                die();
            } else {
                check_string_length($device_search);
            }
            //echo $error_message;
        }
        function died(){
         echo "<br><p class = 'error'>Please fill in either the device number OR device search field</p>";
         die();
         } 
        function check_string_length ($string) {
            if(strlen($string) < 3) {
                $error_css = 'error';
                echo "<p class ='error'>Not enough characters</p>";
                die();
            }
        }
if($_SERVER["REQUEST_METHOD"] == "GET" && empty($_GET['device_search'])) {
    $sql = "SELECT device_id, device_name, device_manufacturer
            FROM testmerrill.Devices 
            WHERE device_id = '{$device_number}' LIMIT 1";
    //echo $sql;
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && empty($_GET['device_number'])) {
    $sql = "SELECT device_id, device_name, device_manufacturer
            FROM testmerrill.Devices   
            WHERE device_name LIKE '{$device_search}%' LIMIT 50";
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
        $subArray[device_id]="<a href='device_search_articles_view.php?device_number={$row["device_id"]}&device_search=$device_search' target='_blank'>{$row["device_id"]}</a>";
        $subArray[device_name]=$row['device_name'];
        $subArray[device_manufacturer]=$row['device_manufacturer'];
        #$subArray[image]="<img src='images/{$row['image']}'>";
        $rows[] = $subArray;
        #echo $row['image'];
    }
    print json_encode($rows);
} else  {
    validate($device_number, $device_search);
} 
?>
