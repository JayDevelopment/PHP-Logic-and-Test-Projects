<?php
require "php_model.php";
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
require "add_device_select_controller.php";
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
require "add_device_controller.php";
?>
</body>
</html>