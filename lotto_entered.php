<?php 
session_start();
function sanatize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $winning_tickets_drawn = sanatize_data($_POST["winning_tickets_drawn"]);
        $lotto_size = sanatize_data($_POST["lotto_size"]);
    }
?>
<html>
<body>
<h2>Hello, <?php echo $_SESSION['name']?>!</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
Size of lotto: <input type="number" value="<?php echo $lotto_size?>" name="lotto_size" required><br>
Number of Winning Tickets: <input type="number" value="<?php echo $winning_tickets_drawn?>" name="winning_tickets_drawn" required><br>
<input type="submit">
</form>

<?php 
$numbers = range(1, ($lotto_size*$lotto_size));
shuffle($numbers);
$winners_array = array_slice($numbers, 1, $winning_tickets_drawn);
echo "The winning numbers: ";
sort($winners_array);
foreach($winners_array as $value){
    echo $value . ' ';
}
createTable($lotto_size,$lotto_size,$winners_array);

function CreateTable($row,$column,$winners_array)
{
    $counter = 1;
    echo '<table border="1" cellpadding="25" cellspacing="0">';
    for($i=1;$i<=$row;$i++)
    {
        echo '<tr>';
        for($j=1;$j<=$column;$j++)
        {
            if(in_array($counter, $winners_array)) {
                echo "<td style='background-color:red'> $counter </td>"; 
                
            } else {
                echo "<td id='$counter'> $counter </td>";
            
        }
        $counter++;
        }
        echo '</tr>';
    }
}
?>
</body>
</html>