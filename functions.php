<?php 
function square ($num) {
    return $num*$num;
}
function cube ($num) {
    return $num*$num*$num;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sqr_num =  square($_POST["num"]);
    $cube_num = cube($_POST["num"]);
}
?>