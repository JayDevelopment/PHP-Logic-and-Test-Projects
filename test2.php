<?php 
$minNum = $_GET['min'];
$maxNum = $_GET['max'];
?>
<html>
<body>
<form action="test2.php" method="get">
Min: <input type="number" name="min" required><br>
Max: <input type="number" name="max" required><br>
<input type="submit">
</form>
</body>
</html>
<?php 
for ($x = $minNum; $x <= $maxNum; $x++) {
  echo $x . " ";
} 
?> 