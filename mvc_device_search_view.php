<?php
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE);
  require "mvc_device_search_model.php";
  require "mvc_device_search_controller.php";
  $error_css =  (strlen($_GET['device_search']) >= 3 ? "class='device_search'" : "class='red'");
  ?>
  <script>
	var device_search = document.getElementById('device_search');
	function disableField(id,id2){
		var disabled = (document.getElementById(id).disabled = false) ? document.getElementById(id).disabled = true : document.getElementById(id2).disabled = true;
	}
	function disableError(){
		document.getElementById('device_search').className = 'device_search';
		}
	//document.getElementById('device_search').style.color = "red";
</script>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<a id='nav-bar' href='mvc_add_device_view.php' target='_blank'>Add a Device</a>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
<div class="box">
<p>Device Number:</p> 
<input type="text" id="device_number" name="device_number" disabled value="<?php echo $_GET['device_number']?>">
<input type="radio" id='device_number_radio' class="device_number" name="device_radio" onclick="disableField('device_number', 'device_search')">
</div>
<br>
<div class="box">
<p>Device Search:</p>
<input type="text" id="device_search" <?php echo $error_css?> name="device_search" value="<?php echo $_GET['device_search']?>" onclick="disableError()">
<input type="radio" id='device_search_radio' class="device_search" name="device_radio" onclick="disableField('device_search', 'device_number')" checked>
<br>
<input type="submit">
</div>
</form>
<table>
<?php
if(isset($_GET) && $_GET['device_search'] != '' || $_GET['device_number'] != '') {
  $model = new Model();
  $db = $model->getConnection();
  $devices = new Devices($db);
  $devices->search = (isset($_GET['device_search'])) ? $_GET['device_search'] : '';
  $devices->number = (isset($_GET['device_number'])) ? $_GET['device_number'] : '';
  $stmt = $devices->read();
  echo "<th>Device Number</th>
        <th>Device Name</th>
        <th>Device Manufacturer</th>";
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    echo "
    <tr> 
    <td><a href='mvc_device_article_view.php?device_number={$row["device_id"]}&device_search=$devices->search' target='_blank'>{$row["device_id"]}</a></td>
    <td>{$row['device_name']}</td>
    <td>{$row['device_manufacturer']}</td>
    </tr>";
  } 
} 
?>
</table>
</body>
</html>