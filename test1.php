<?php 
echo "Hello, it is " . date("d.m.Y H:i");
echo "</br>",
     "</br>";
for ($x = 0; $x <= 100; $x++) {
    echo $x . " " ;
} 
echo "</br>",
     "</br>";
for ($x = 0; $x <= 100; $x++) {
    if($x % 5) {
        echo $x . " "; 
    };
    } 
?>