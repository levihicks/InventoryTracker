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
    <form id="searchForm" action="search.php" method="post">
        <!form onsubmit="window.location.href='Results.html';return false;">
    		<input type="text" name="itemName" placeholder="Find Item...">
		<input type="submit" value="Search">
		<label>Sort by:</label>
		<select name="sorts">
			<option value="relevance">Relevance</option>
			<option value="price asc">Price (Low to High)</option>
      <option value="price desc">Price (High to Low)</option>
			<option value="name asc">Item Name (Ascending)</option>
      <option value="name desc">Item Name (Descending)</option>
			<option value="on_hand asc">Quantity (Low to High)</option>
      <option value="on_hand desc">Quantity (High to Low)</option>
		</select>
		
		
		<input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
    		<input type="hidden" name="loggedin" value="True">
    	</form>
     <hr>
<?PHP
	include "fun.php"; //connection
	$rpp = 10;	// results per page
	if($_POST["prevClick"]==$_POST["nextClick"])
		$_SESSION["searchIndex"]=0; // fresh search
	if ($_POST["prevClick"]=="clicked")
    	$_SESSION["searchIndex"]-=$rpp; 
  if ($_POST["nextClick"]=="clicked")
    $_SESSION["searchIndex"]+=$rpp;
	if($_SESSION["searchIndex"]==0 && $_POST["prevClick"]!="clicked"){ 
    $subquery="SELECT name, upc FROM items WHERE
    upper(name) LIKE upper('%" .$_POST["itemName"] ."%')";
    $query="SELECT count(*) FROM 
    ((SELECT * FROM sells WHERE store = $store) as s0
    NATURAL JOIN ($subquery) as s1)"; // get total results count
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
    $row=$sqlquery->fetch();
    $_SESSION["resultCount"] = $row[0];
		$_SESSION["sorts"]=$_POST["sorts"];
		$_SESSION["itemName"]=$_POST["itemName"];
  }
  $subquery="SELECT name, upc FROM items WHERE
  upper(name) LIKE upper('%" .$_SESSION["itemName"] ."%')";
  $query="SELECT s1.upc, name, price, on_hand FROM 
  ((SELECT * FROM sells WHERE store = $store) as s0
  NATURAL JOIN ($subquery) as s1)";
  if($_SESSION["sorts"]!="relevance")
    $query.=" order by " .$_SESSION["sorts"]. "";
  $query.=" limit $rpp offset " .$_SESSION["searchIndex"]. "";
  $sqlquery=$conn->prepare($query);
  $sqlquery->execute();
  $i;
  for($i = 0; ($i < $rpp && $row = $sqlquery->fetch()); $i++)
  {
    $items [$i] = array('UPC'=>$row[0], 'Item'=>$row[1], 'Price'=>$row[2], 'Store Count'=>$row[3]);
  } 
  
  echo "<h1> Results </h1>";
  if ($i == 0)
    echo"<h1>No results found for '" .$_SESSION["itemName"] ."'</h1>";
  echo "<form id=\"resultsForm\" method=\"post\">";
  echo build_table($items); //html table
  echo "</form>";
  if ($_SESSION["searchIndex"]!=0){
    echo "<button id=\"searchPrev\">Prev</button>";
  }
  echo "<div class=\"resultCountContainer\">Showing results " .($_SESSION["searchIndex"]+1)."-"
  .(($_SESSION["searchIndex"])+$i)." out of ".$_SESSION["resultCount"]."</div>";
  if($_SESSION["resultCount"] > ($_SESSION["searchIndex"]+$rpp)){
    echo  "<button id=\"searchNext\">Next</button>";
  }
?>
  </body>
    <script>
      function submitInfoForm(action){ // submits form for more item info
	     document.getElementById('resultsForm').action = action;
    	 document.getElementById('resultsForm').submit();	    
      }
      function submitSearchForm(action){ // submits form for search for next and prev buttons
	     document.getElementById('searchForm').action = action;
	     document.getElementById('searchForm').submit();
	    }
      var rows = document.querySelectorAll("tr");
      for (var i = 1; i < rows.length; i++) {
        var moreInfoButton = document.createElement("a");
        moreInfoButton.href="#";
        moreInfoButton.innerText="[More Info]";
        moreInfoButton.onclick=function(){
          var upc = this.parentNode.children[0].innerText;
          var t = document.createElement("input");
          t.setAttribute("name", "test");
          t.setAttribute("value", upc);
          var c=this;
          for(var i = 0; i < 4; i++) 
            c=c.parentNode; // form for more info
          t.setAttribute("style", "display:none;");
          c.appendChild(t);
          submitInfoForm('salesInfo.php');
        };
        rows[i].appendChild(moreInfoButton);
      }
      var nextBut = document.getElementById('searchNext');
      var prevBut = document.getElementById('searchPrev');
      function clickSubmit(clicked){
	      var searchForm = document.getElementById('searchForm');
	      clicked.setAttribute("style", "display: none;");
	      searchForm.appendChild(clicked);
	      submitSearchForm('search.php');
      };
      if(nextBut!=null){
        nextBut.onclick=function(){
          var clicked = document.createElement('input');
  	      clicked.setAttribute("name", "nextClick");
  	      clicked.setAttribute("value", "clicked");
  	      clickSubmit(clicked);
        };
      }
      if(prevBut!=null){
        prevBut.onclick=function(){
  	     var clicked = document.createElement('input');
  	     clicked.setAttribute("name", "prevClick");
  	     clicked.setAttribute("value", "clicked");
  	     clickSubmit(clicked);
        };
      }
	</script>
</html>
