<?php include 'functions.php';?>
<html>
<body>
<form action="test.php" method="post">
Pick a number: <input type="number" value='<?php echo $_POST["num"]?>' name="num" required>
<br>
<input type="submit">
</form>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Number Squared: " . square($_POST["num"]) . "<br>" .
        "Number Cubed: " . cube($_POST["num"]);
    }
?>
</body>
</html>



