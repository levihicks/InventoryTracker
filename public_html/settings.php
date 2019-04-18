<?PHP include 'user.php'; include "fun.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/settingsStyle.css" rel="stylesheet" type="text/css">
        <!link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title> Settings </title>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
      <h1>Settings</h1>
      
      <div class="setting">
        
          <hr>
          <h2>Low Stock Notifications</h2>
          <h3>Receive notifications at your email and/or phone via text. 
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
            <input type="submit" onclick="submitEmailForm('emailUpdate.php')" value="Update">
            
            <?php
              if($email!="")
                echo "<input type=\"submit\" onclick=\"submitEmailForm('emailRemove.php')\" value=\"Remove\">";
            ?>
          </form>
          <br>
          <form id="phoneNotificationForm" method="post">
            <label>Phone Number:</label>
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
            <input type="submit" onclick="submitPhoneForm('phoneUpdate.php')" value="Update">
            <?php
              if($phoneNumber!="")
                echo "<input type=\"submit\" onclick=\"submitPhoneForm('phoneRemove.php')\" value=\"Remove\">";
            ?>
            </form>
        
      </div>
    </body>
    <script>
        function submitEmailForm(action)
        {
            document.getElementById('emailNotificationForm').action = action;
            document.getElementById('emailNotificationForm').submit();
        }
        function submitPhoneForm(action)
        {
            document.getElementById('phoneNotificationForm').action = action;
            document.getElementById('phoneNotificationForm').submit();
        }
    </script>
</html>
<?PHP exit() ?>