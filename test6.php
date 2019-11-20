<?php 
session_start();
/*function sanatize_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} */
function accept_and_store_articles () {
    if (isset($_GET['articles']) && is_numeric($_GET['articles'])) {
        $_SESSION['articles'][] = $_GET['articles'];
        //$_SESSION['articles'][$_GET['articles']] = $_GET['articles'];
        print_r($_SESSION[articles]);
    }
}
function delete_article () {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $find = array_search($_GET['delete'],$_SESSION['articles']);
        //print_r($find);
        if($find !== false) {
            //var_dump($_SESSION['articles']);
            unset($_SESSION['articles'][$find]);
            $_SESSION["articles"] = array_values($_SESSION["articles"]);
        } 
        //unset($_SESSION['articles'][$_GET['delete']]);
       /*foreach($_SESSION['articles'] as $k => $v) {
            if($v == $_GET['delete']) {
                //var_dump($_SESSION['articles']);
                unset($_SESSION['articles'][$k]);
        } */
       
    } 
  }
function delete_all () {
    if (isset($_GET['delete_all'])) {
        unset($_SESSION['articles']);
    }
}
 
function retrieve_and_display_articles () {
    $article_amount = count($_SESSION['articles']);
    //sort($_SESSION['articles']);
    foreach($_SESSION['articles'] as $item){
        echo $item . ' ' .  "<a href='test6.php?delete={$item}'>Delete</a>" . '<br>';
    }
    echo "<br>";
    if($article_amount != 0) {
        echo "You have now stored {$article_amount} article numbers";
    } else {
        echo "You have not saved an item number yet";
    }
}
accept_and_store_articles ();
delete_article ();
delete_all ();
?>
<html>
<h2>NotePad</h2>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
Enter Article Number: <input type="number" name="articles">
Delete Article Number: <input type="number" name="delete">
<br>
<br>
<input type="submit" value="Submit">
<br>
<br>
<?php retrieve_and_display_articles ();?>
<br>
<br>
<br>
<br>
<br>
Delete Entire NotePad: <input style="color:red" type="submit" value="Delete All" name="delete_all">
<br>
</form>
</body>
</html>