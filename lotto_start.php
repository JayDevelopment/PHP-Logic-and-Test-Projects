<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
session_start();
// define variables and set to empty values
$nameErr = "";
$name =  "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ((empty($_POST["name"]))) {
        $nameErr = "Name is required";
    } else {
        $name = sanatize_data($_POST["name"]);
        header("Location:lotto_entered.php?name=$name");
        // check if name only contains letters and whitespace
    }
    $_SESSION['name'] = $_POST['name'];
}

function sanatize_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<?php

?>
<h2>Enter the Lotto: </h2>
<form method="post" action="lotto_start.php">    
  Name: <input type="text" name="name" value="<?php echo $_SESSION['name'];?>">
  <span class="error"> <?php echo $nameErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Next">  
</form>


</body>
</html>
