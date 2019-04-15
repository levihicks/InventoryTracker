<?PHP include 'user.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title>Results</title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
    <form action="search.php" method="post">
        <!form onsubmit="window.location.href='Results.html';return false;">
    		<input type="text" name="itemName" placeholder="Find Item...">
    		<input type="submit" value="Search">
    		<input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
    		<input type="hidden" name="loggedin" value="True">
    	</form>
     <hr>
        <?PHP
//construct query
    include "fun.php"; //connection
    $subquery="SELECT name, upc FROM items WHERE
    upper(name) LIKE upper('%" .$_POST["itemName"] ."%')";
    $query="SELECT s1.upc, name, price, on_hand FROM 
        ( (SELECT * FROM sells WHERE store = $store) as s0
           NATURAL JOIN ($subquery) as s1)";

//build array
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
    $i;
    for($i = 0; $row = $sqlquery->fetch(); $i++)
    {
        $items [$i] = array('UPC'=>$row[0], 'Item'=>$row[1], 'Price'=>$row[2], 'Store Count'=>$row[3]);
    }

    
    echo "<h1> Results </h1>";
    if ($i == 0)
      echo"<h1>No results found for '" .$_POST["itemName"] ."'</h1>";
    echo "<form id=\"resultsForm\" method=\"post\">";
    echo build_table($items); //html table
    echo "</form>";
?>
    </body>
    <script>
 /*   function background(){
    	var background = document.createElement('div');
    	background.setAttribute('class', 'background');
    	background.setAttribute("width",window.innerHeight);
    	background.setAttribute("height",window.innerWidth);
    	
    	return background;
    }*/
    function submitForm(action){
	    document.getElementById('resultsForm').action = action;
    	    document.getElementById('resultsForm').submit();	    
    }
      var rows = document.querySelectorAll("tr");
      for (var i = 1; i < rows.length; i++) {
        var moreInfoButton = document.createElement("a");
	//moreInfoButton.setAttribute("type", "submit");
	moreInfoButton.href="#";
	moreInfoButton.innerText="[More Info]";
        //moreInfoButton.onclick=function(popup){
        /*var popup = document.createElement("div");
        popup.setAttribute("class", "moreInfo");
          var upc = this.parentNode.children[0].innerText;
          console.log(upc);
          var b = document.querySelector("body");
          b.appendChild(background());
          
          b.appendChild(popup);
          var exitButton = document.createElement('button');
      		exitButton.setAttribute('class', 'exitInfo');
      		exitButton.innerText='x';
      		exitButton.onclick=function(){
            var moreInfo = document.querySelector('.moreInfo');
      			popup.remove();
      			var bg = document.querySelector('.background');
      			bg.remove();
      		};
          
      		popup.prepend(exitButton);*/
          
	//};
	//
	moreInfoButton.onclick=function(){
		var upc = this.parentNode.children[0].innerText;
		//upcContainer.setAttribute("name", "selected");
		//upcContainer.setAttribute("value", upcContainer.innerText);
		console.log(upc);
		var t = document.createElement("input");
		t.setAttribute("name", "test");
		t.setAttribute("value", upc);
		var c=this;
		for(var i = 0; i < 4; i++) 
			c=c.parentNode;
		console.log(c);
		t.setAttribute("style", "display:none;");
		c.appendChild(t);
		submitForm('salesInfo.php');
	};
        rows[i].appendChild(moreInfoButton);
        
      }
    

    </script>
</html>
