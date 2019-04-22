<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport content="width=device-width, initial-scale=1.0">
		<link href="styles/resultsstyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title>Results</title>
        <?PHP include 'nav.php'; ?>
    </head>


<?php 
  include 'fun.php';
  include 'user.php';
  $rpp = 10;
  if ($_POST["prevClick"]==$_POST["nextClick"])
    $_SESSION["salesIndex"]=0;
  if ($_POST["prevClick"]=="clicked")
    	$_SESSION["salesIndex"]-=$rpp; 
  if ($_POST["nextClick"]=="clicked")
    $_SESSION["salesIndex"]+=$rpp;
  if($_SESSION["salesIndex"]==0 && $_POST["prevClick"]!="clicked"){ 
    $query = "select count(*) from sales where item = '" .$_POST["test"] ."' and store=$store;";
    $sqlquery=$conn->prepare($query);
    $sqlquery->execute();
    $row=$sqlquery->fetch();
    $_SESSION["resultCount"] = $row[0];
		$_SESSION["test"]=$_POST["test"];
  }
  
    $query = "select * from sales where item = '" .$_SESSION["test"] ."' and store=$store";
    $query.=" limit $rpp offset " .$_SESSION["salesIndex"]. "";
   //echo "<h1> Sales History <h1>";
   $sqlquery=$conn->prepare($query);
   $sqlquery->execute();
 
    $i=0;
    for($i = 0;($i<$rpp && $row = $sqlquery->fetch()); $i++)
   {
        $items [$i] = array('UPC'=>$row[0], 'Store'=>$row[1], 'Quantity'=>$row[2], 'Time of Sale'=>$row[3], 'Sale ID'=>$row[4]);
    }
    if($i!=0){
      echo "<h1>Charts</h1><img id=\"weekImg\" src=\"http://3.16.210.106/~robert/images/".$_SESSION["test"]."store".$store."week.png\">
                           <img id=\"monthImg\" src=\"http://3.16.210.106/~robert/images/".$_SESSION["test"]."store".$store."month.png\">
                           <img id=\"yearImg\" src=\"http://3.16.210.106/~robert/images/".$_SESSION["test"]."store".$store."year.png\">";
      echo"<br>";
      echo "<a id=\"weekImgLink\" href='#'>Past Week</a><a  id=\"monthImgLink\" href='#'>Past Month</a><a  id=\"yearImgLink\" href='#'>Past Year</a>";
    }
    else
      echo "<h1>Chart Not Available (No Sales History)</h1>";

    echo "<h1> Sales History <h1>";
    
    if ($i == 0)
      echo"<h1>No sales history found.</h1>";
    echo "<form id=\"salesForm\" method=\"post\">";
    echo build_table($items);
    echo "</form>";
    if ($_SESSION["salesIndex"]!=0){
    echo "<button id=\"searchPrev\">Prev</button>";
    }
    echo "<div class=\"resultCountContainer\">Showing results " .(($i==0)?$i:$_SESSION["salesIndex"]+1)."-"
  .(($_SESSION["salesIndex"])+$i)." out of ".$_SESSION["resultCount"]."</div>";
  if($_SESSION["resultCount"] > ($_SESSION["salesIndex"]+$rpp)){
    echo  "<button id=\"searchNext\">Next</button>";
  }
  
?>
<script>

  var weekImg = document.getElementById("weekImg");
  var monthImg = document.getElementById("monthImg");
  var yearImg = document.getElementById("yearImg");
  weekImg.style="display: none;";
  monthImg.style="display: none;";
  yearImg.style="display: none;";

  var weekImgLink = document.getElementById("weekImgLink");
  weekImgLink.onclick=function(){
    weekImg.style="display: inline-block;";
    monthImg.style="display: none;";
    yearImg.style="display: none;";
  }
  var monthImgLink = document.getElementById("monthImgLink");
   monthImgLink.onclick=function(){
    monthImg.style="display: inline-block;";
    weekImg.style="display: none;";
    yearImg.style="display: none;";
  }
  var yearImgLink = document.getElementById("yearImgLink");
  yearImgLink.onclick=function(){
    yearImg.style="display: inline-block;";
    monthImg.style="display: none;";
    weekImg.style="display: none;";
  }
  weekImgLink.click();
  function submitMoreInfoForm(action){ // submits form for more item info
	     document.getElementById('salesForm').action = action;
    	 document.getElementById('salesForm').submit();	    
      }
      var nextBut = document.getElementById('searchNext');
      var prevBut = document.getElementById('searchPrev');
      function clickSubmit(clicked){
	      var searchForm = document.getElementById('salesForm');
	      clicked.setAttribute("style", "display: none;");
	      searchForm.appendChild(clicked);
	      submitMoreInfoForm('salesInfo.php');
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
