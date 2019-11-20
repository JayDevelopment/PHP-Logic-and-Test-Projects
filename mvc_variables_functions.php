<?php 
function sanatize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 
$device_number = sanatize_data($_GET['device_number']);
$device_search = sanatize_data($_GET['device_search']);
?>