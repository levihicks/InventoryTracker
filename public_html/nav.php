<html lang="en-US">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
         <link href="styles/navStyle.css" rel="stylesheet" type="text/css">
    	
    </head>
    <body>
        <form action="profile.php" method="post">
            <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
            <input type="hidden" name="loggedin" value="True">
        </form>
        <ul>
            <li>
                <input type="image" src="./images/hamburger.png" id="hamburgerMenu">
                <form action="main.php" method="post">
                <!form onsubmit="window.location.href='Options.html';return false;">
                    <input type="submit" value="Inventory Tracker">
                    <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
                    <input type="hidden" name="loggedin" value="True">
                </form>
            </li>
            <li id="options">
               <form action="profile.php" method="post">
                <!form onsubmit="window.location.href='Profile.html';return false;"> 
                    <input type="submit" value="Profile">
                    <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
                    <input type="hidden" name="loggedin" value="True">
                </form>
                <form action="staff.php" method="post">
                <input type="submit" value="Staff" >
                <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?> >
                <input type="hidden" name="loggedin" value="True" >
            </form>
                <form action="logout.php" method="post">
                <!form onsubmit="window.location.href='Login.html';return false;">
                    <input type="submit" value="[Log out]">
                </form>
            </li>

        </ul>
    </body>
    <script>
      var optionsDisplayed=false;
      var mobileOptions = document.querySelector("#options");
  		var hamburgerMenu = document.querySelector('#hamburgerMenu');
  		hamburgerMenu.onclick=function(){
        mobileOptions.style.display = (optionsDisplayed)?'none':'inline-block';
        optionsDisplayed=!optionsDisplayed;
      };
      window.onresize=function(){
        if(window.innerWidth>550 && mobileOptions.style.display!='inline-block')
          mobileOptions.style.display='inline-block';
        else if(window.innerWidth<=550)
          mobileOptions.style.display = (!optionsDisplayed)?'none':'inline-block';
      };
	  </script>	
</html>
