<?php 
ini_set ('display_errors', 'On');
ini_set ('file_uploads', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
require_once '/var/www/libs/db.php';
$link = open_db1();
?>