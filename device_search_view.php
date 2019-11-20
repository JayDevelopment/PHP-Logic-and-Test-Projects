<?php include 'device_search_table_controller.php'?>
<script>
function disableField(id,id2){
	var disabled = (document.getElementById(id).disabled = false) ? document.getElementById(id).disabled = true : document.getElementById(id2).disabled = true;
} 
	function disableError(){
		document.getElementById('device_search').className = 'device_search';
		}

	function generateDynamicTable(data){
			var noOfdevices = data.length;
			
			if(noOfdevices>0){
				
	 
				// CREATE DYNAMIC TABLE.
				var table = document.createElement("table");
				table.style.width = '75%';
				table.setAttribute('border', '1');
				table.setAttribute('cellspacing', '0');
				table.setAttribute('cellpadding', '5');
				
				// retrieve column header
	 
				var col = []; // define an empty array
				for (var i = 0; i < noOfdevices; i++) {
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
				for (var i = 0; i < noOfdevices; i++) {
				
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
</script>
<html>
<head> 
<link rel="stylesheet" href="phpmitsql.css">
</head>
<body>
<a id='nav-bar' href='add_device_view.php' target='_blank'>Add a Device</a>
<form action="" method="get">
<div class="box">
<p>Device Number:</p> 
<input type="text" id="device_number" name="device_number" disabled value="<?php echo $_GET['device_number']?>" oninput="showTable()">
<input type="radio" id='device_number_radio' class="device_number" name="device_checkbox" onclick="disableField('device_number', 'device_search')">
</div>
<br>
<div class="box">
<p>Device Search:</p>
<input type="text" id="device_search" <?php echo $error_css?> name="device_search" value="<?php echo $_GET['device_search']?>" onclick="disableError()" oninput="showTable()">
<input type="radio" id='device_search_radio' class="device_search" name="device_checkbox" onclick="disableField('device_search', 'device_number')" checked>
</div>
<br>
</form>
<script>	
	var deviceSearch = document.getElementById('device_search');
	var deviceNumber = document.getElementById('device_number');
</script>
<br>
<span id="response" style="margin:auto"></span>
<br>
</body>
</html>
