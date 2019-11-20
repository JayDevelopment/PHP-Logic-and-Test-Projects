<script>
function showTable() {
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
	  xhttp.open("GET", "device_search_controller.php?device_search="+deviceSearch.value+"&device_number="+deviceNumber.value+"&device_radio=on", true);
	  xhttp.send();
	  document.getElementById("response").innerHTML = '';
	}
</script>