 <?php
$sql_options = "SELECT article_id, article_name FROM testmerrill.Articles"; 
$query_options = query_db1($sql_options);

if (mysqli_num_rows($query_options) > 0) {
   
    while($row=result_db1($query_options)) {
        echo "<option value='{$row['article_id']}'>{$row['article_name']}</option>";
    }
} 
?>