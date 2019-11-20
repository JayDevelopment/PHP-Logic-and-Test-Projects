<?php 
ini_set ('display_errors', 'On');
error_reporting(E_ALL & ~ E_NOTICE); 
$error_css =  (strlen($_GET['article_search']) >= 3 ? "class='article_search'" : "class='red'");
$article_number = sanatize_data($_GET['article_number']);
$article_search = sanatize_data($_GET['article_search']);
$active_articles = (isset($_GET['active_articles']))
? "AND V3002_011 = 1"
    : '';
    $in_stock = (isset($_GET['in_stock']))
    ? "AND STOCK <> 0"
        : '';
        function sanatize_data($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function validate($article_number, $article_search) {
            if(!isset($article_search) && $article_number != '') {
                $error_message = "<p class = 'error'>The article number {$article_number} is invalid or not available under the checked conditions</p>";
            } elseif(!isset($article_number) && $article_search != '') {
                $error_message = "<p class = 'error'>For the term {$article_search} there were no matches</p>";
            } else {
                check_string_length($article_search);
            }
            echo $error_message;
        }
        /*function died(){
         echo "<span class = 'error'>Please fill in either the article number OR article search field</span>";
         die();
         } */
        function check_string_length ($string) {
            if(strlen($string) < 3) {
                echo "<p class ='error'>Not enough characters</p>";
                die();
            }
        }
?>
<script>
	function disableField(id,id2){
		//console.log(id);
		//var checked = (document.getElementById(id).checked = true) ? document.getElementById(id).checked = false : document.getElementById(id).checked = false;
		var disabled = (document.getElementById(id).disabled = false) ? document.getElementById(id).disabled = true : document.getElementById(id2).disabled = true;
	} 
	function disableError(){
		document.getElementById('article_search').className = 'article_search';
		}

	function generateDynamicTable(data){
			var noOfArticles = data.length;
			
			if(noOfArticles>0){
				
	 
				// CREATE DYNAMIC TABLE.
				var table = document.createElement("table");
				table.style.width = '75%';
				table.setAttribute('border', '1');
				table.setAttribute('cellspacing', '0');
				table.setAttribute('cellpadding', '5');
				
				// retrieve column header
	 
				var col = []; // define an empty array
				for (var i = 0; i < noOfArticles; i++) {
					for (var key in data[i]) {
						if (col.indexOf(key) === -1) {
							col.push(key);
						}
					}
				}
				
				// CREATE TABLE HEAD .
				var tHead = document.createElement("thead");	
					
				
				// CREATE ROW FOR TABLE HEAD .
				var hRow = document.createElement("tr");
				
				// ADD COLUMN HEADER TO ROW OF TABLE HEAD.
				for (var i = 0; i < col.length; i++) {
						var th = document.createElement("th");
						th.innerHTML = col[i];
						hRow.appendChild(th);
				}
				tHead.appendChild(hRow);
				table.appendChild(tHead);
				
				// CREATE TABLE BODY .
				var tBody = document.createElement("tbody");	
				
				// ADD COLUMN HEADER TO ROW OF TABLE HEAD.
				for (var i = 0; i < noOfArticles; i++) {
				
						var bRow = document.createElement("tr"); // CREATE ROW FOR EACH RECORD .
						
						
						for (var j = 0; j < col.length; j++) {
							var td = document.createElement("td");
							td.innerHTML = data[i][col[j]];
							bRow.appendChild(td);
						}
						tBody.appendChild(bRow)
	 
				}
				table.appendChild(tBody);	
				
				
				// FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
				document.getElementById("response").appendChild(table);
			}	
			
		}


	
	function showTable() {
		if(activeArticles.checked == false) {
			var activeOnOff = "";
			} else {
			var activeOnOff = "&active_articles=on";
				}
		if(inStock.checked == false) {
			var stockOnOff = "";
			} else {
			var stockOnOff = "&in_stock=on";
				}
		if (inStock.checked == false) {
			inStock.value = '';
				}
		//var query = "php_database_call.php?article_search="+articleSearch.value+"&article_number="+articleNumber.value+"&article_radio=on"+activeOnOff+stockOnOff;
		  xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	console.log(this.responseText);
			    if(/<\/p>/.test(this.responseText)) {
		    	document.getElementById("response").innerHTML = this.responseText;
			    } else {
			    console.log(this.responseText);
			    parsedResponse = JSON.parse(this.responseText);
			    console.log(parsedResponse);
			   generateDynamicTable(parsedResponse);
			    }
		    }
		  };
		  xhttp.open("GET", "php_database_call.php?article_search="+articleSearch.value+"&article_number="+articleNumber.value+"&article_radio=on"+activeOnOff+stockOnOff, true);
		  xhttp.send();
		  document.getElementById("response").innerHTML = '';
		}
</script>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<form action="" method="get">
<div class="box">
<p>Article Number:</p> 
<input type="text" id="article_number" name="article_number" disabled value="<?php echo $_GET['article_number']?>" oninput="showTable()">
<input type="radio" id='article_number_radio' class="article_number" name="article_checkbox" onclick="disableField('article_number', 'article_search')">
</div>
<br>
<div class="box">
<p>Article Search:</p>
<input type="text" id="article_search" <?php echo $error_css?> name="article_search" value="<?php echo $_GET['article_search']?>" onclick="disableError()" oninput="showTable()">
<input type="radio" id='article_search_radio' class="article_search" name="article_checkbox" onclick="disableField('article_search', 'article_number')" checked>
</div>
<br>
<div class="box">
<input type="checkbox" id="active_articles_checkbox" name="active_articles" <?php if (isset($_GET['active_articles'])) echo " checked='checked'"?> onclick="showTable()">
<p>Only active articles</p>
</div>
<br>
<div class="box"> 
<input type="checkbox" id= "in_stock_checkbox"name="in_stock" <?php if (isset($_GET['in_stock'])) echo " checked='checked'"?> onclick="showTable()">
<p>Only in stock items</p>
<br>
</div>
</form>
<br>
<br>
<span id="response" style="margin:auto"></span>
<br>
<script>
var articleSearch = document.getElementById('article_search');
var articleNumber = document.getElementById('article_number');
var activeArticles = document.getElementById('active_articles_checkbox');
var inStock = document.getElementById('in_stock_checkbox');
</script>
</body>
</html>