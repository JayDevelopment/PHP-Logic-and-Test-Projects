<?php 
function sanatize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$device_name = sanatize_data($_POST['device_name']);
$device_manufacturer = sanatize_data($_POST['device_manufacturer']);

if(isset($_POST['device_name']) && isset($_POST['device_manufacturer']) && isset($_POST['articles'])) {
$sql_update1 = "INSERT INTO testmerrill.Devices (device_name, device_manufacturer)
VALUES ('{$device_name}', '{$device_manufacturer}')";
query_db1($sql_update1);
$last_id = (mysqli_insert_id($link));
foreach ($_POST['articles'] as $article => $number) {
    $sanatized_article = sanatize_data($_POST['articles'][$article]);
    $sql_update2 = "INSERT INTO testmerrill.Device_Article_Connection (device_id, article_id)
    VALUES ('{$last_id}','{$sanatized_article}')";
    query_db1($sql_update2);
}
echo "<p class = 'error'>Device Created</p>";
} else {
    echo "<p class = 'error'>*Please fill out the entire form</p>";
} 
/*if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    
    // image file directory
    $target = "images/".basename($image);
    
    $sql_image = "INSERT INTO testmerrill.Devices (image) VALUES ('$image')";
    // execute query
    query_db1($sql_image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		echo "Image uploaded successfully";
  	}else{
  	     echo "Failed upload";
  	}
}*/
?>