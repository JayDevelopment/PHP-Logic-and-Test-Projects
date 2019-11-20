<!DOCTYPE html>
<html>
<head>
<title>Crazy Squares</title>
</head>
<h1>Crazy Squares</h1>
<body>

<?php
        $color_array=array("yellow"=>"0","red"=>"1","green"=>"2","blue"=>"3","black"=>"4","brown"=>"5", "gray"=>"6");

        for ($i = 0; $i <= 100; $i++) {
            echo '<div style="position:absolute;top:' . rand(0,1200) . 'px;right:' . rand(0,1200) . 'px;left:' . rand(0,1200) . 'px;bottom:' . rand(0,1200) . 'px;width:' . rand(10,100) . 'px;height:' . rand(10,100) . 'px;background-color:' . array_rand($color_array,1) . '"></div></br>';
        }
?>

</body>

</html> 

