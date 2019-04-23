<?PHP include 'user.php'; include "fun.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/settingsStyle.css" rel="stylesheet" type="text/css">
        <!link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title> Notifications </title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
      <h1>Notifications</h1>
      
      <div class="setting">
        
          <hr>
          <h2>Stock Notifications</h2>
          <h3>Receive daily stock reports at your email and/or phone via text. 
          <br>(Standard messaging rates may apply)</h3>
          <form id="emailNotificationForm" method="post">
            <label>E-mail:</label>
            <?php
              $query = "select * from emails where employee = '$user';";
              $sqlquery=$conn->prepare($query);
              $sqlquery->execute();
              $row = $sqlquery->fetch();
              if($row)
                $email=$row[1];
              else
                $email="";
              ?>
            <input type="text" name="emailInput" value=<?php echo $email; ?>>
            <input id="emailUpdate" type="button" onclick="submitEmailForm('emailUpdate.php')" value="Update">
            
            <?php
              if($email!="")
                echo "<input type=\"button\" onclick=\"submitEmailForm('emailRemove.php')\" value=\"Remove\">";
              if($_SESSION["emailUpdated"]==true){
                echo "<div class=\"updateSuccess\">Update successful. Check your e-mail for confirmation.</div>";
                $_SESSION["emailUpdated"]=false;
              }
            ?>
          </form>
          <br>
          <form id="phoneNotificationForm" method="post">
            <label>10-digit Phone Number:</label>
            <?php
              $query = "select * from phoneNumbers where employee = '$user';";
              $sqlquery=$conn->prepare($query);
              $sqlquery->execute();
              $row = $sqlquery->fetch();
              
              if($row)
                $phoneNumber=$row[1];
              else
                $phoneNumber="";
              ?>
            <input type="text" name="phoneInput" value=<?php echo $phoneNumber; ?>>
            <input id="phoneUpdate" type="button" onclick="submitPhoneForm('phoneUpdate.php')" value="Update">
            <?php
              if($phoneNumber!="")
                echo "<input type=\"button\" onclick=\"submitPhoneForm('phoneRemove.php')\" value=\"Remove\">";
              if($_SESSION["phoneUpdated"]==true){
                echo "<div class=\"updateSuccess\">Update successful. Check messages for confirmation.</div>";
                $_SESSION["phoneUpdated"]=false;
              }
              
                
            ?>
            </form>
        
      </div>
    </body>
    <script>
    var phoneRegex = /^\d{10}$/;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+(\.[a-zA-Z]{2,4})$/;
    	var phoneInput = document.querySelector("input[name=phoneInput]");
        phoneInput.value = phoneInput.value.slice(2);
        
        function submitEmailForm(action)
        {
        	  var form = document.getElementById('emailNotificationForm');
        	  var emailInput = document.querySelector("input[name=emailInput]");
            if(emailRegex.test(emailInput.value) || action=='emailRemove.php'){
              document.getElementById('emailNotificationForm').action = action;
              document.getElementById('emailNotificationForm').submit();
            }
            else{
             if(document.querySelector(".badEmailInput")==null){
               var badInput = document.createElement("div");
               badInput.setAttribute("class", "badEmailInput");
               badInput.textContent = "Incorrect input, please try again.";
               form.appendChild(badInput);
             }
           }
              
        }
        function submitPhoneForm(action)
        {
          var form = document.getElementById('phoneNotificationForm');
        	var phoneInput = document.querySelector("input[name=phoneInput]");
          if(phoneRegex.test(phoneInput.value) || action=='phoneRemove.php'){
        	  //phoneInput.value = "+1"+phoneInput.value;
            form.action = action;
            form.submit();
           }
           else{
             if(document.querySelector(".badPhoneInput")==null){
               var badInput = document.createElement("div");
               badInput.setAttribute("class", "badPhoneInput");
               badInput.textContent = "Incorrect input, please try again.";
               form.appendChild(badInput);
             }
           }
        }
    </script>
</html>
<?PHP exit() ?>