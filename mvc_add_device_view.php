<?php 
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
require "mvc_device_search_model.php";
require "mvc_device_search_controller.php";
require "mvc_article_controller.php";
$model = new Model();
$db = $model->getConnection();
$devices = new Devices($db);
$articles = new Articles($db);
?>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
<div class="box">
 <label class='responsive'>Device Name:</label> 
<input type="text" id="device_name" name="device_name"  value="<?php echo $_POST['device_name']?>">
<br>
<br>
 <label class='responsive'>Device Manufacturer:</label>
<input type="text" id="device_manufacturer" name="device_manufacturer"  value="<?php echo $_POST['device_manufacturer']?>">
<br>
 <label class='responsive'>Select Article Connections:</label> 
<select id="articles" name="articles[]" multiple size='4'>
 <?php
 $stmt = $articles->readAll();
 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
     echo "<option value='{$row['article_id']}'>{$row['article_name']}</option>";
 }
?>
</select>
<br>
<!--<label class='responsive'>Add a Picture:</label>
<input type="file" name="image"> -->
<br>
<input type="submit" name="upload">
</div>
<br>
</form>
<?php
$devices->create($_POST['device_name'], $_POST['device_manufacturer'], $_POST['articles']);
?>
</body>
</html>
