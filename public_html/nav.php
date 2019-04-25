<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link href="styles/navStyle.css" rel="stylesheet" type="text/css">

<form action="profile.php" method="post">
</form>
<ul>
  <li>
      <input type="image" src="./images/hamburger.png" id="hamburgerMenu" alt="#">
      <form action="main.php" method="post">
      <!form onsubmit="window.location.href='Options.html';return false;">
          <input type="submit" value="Inventory Tracker">
      </form>
  </li>
  <li id="options">
     <form action="profile.php" method="post">
      <!form onsubmit="window.location.href='Profile.html';return false;"> 
          <input type="submit" value="Profile">
      </form>
     <form action="stores.php" method="post">
          <input type="submit" value="Stores" >
      </form>
      <?PHP if ( $user_permissions["staff"] == "true" ) /*Check permission */:?>
      <form action="staff.php" method="post">
          <input type="submit" value="Staff" >
      </form>
      <?PHP endif; ?>
      <form action="settings.php" method="post">
          <input type="submit" value="Notifications">
      </form>
      <form action="logout.php" method="post">
          <!form onsubmit="window.location.href='Login.html';return false;">
          <input type="submit" value="[Log out]">
      </form>
  </li>

</ul>

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

