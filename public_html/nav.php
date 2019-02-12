
<html>
<head>
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }
    
    li {
        float: left;
    }
    
    li input[type=submit] {
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    
    li input[type=submit]:hover {
        background-color: silver;
    }
</style>
</head>
<body>
    <form action="profile.php" method="post">
        <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?> >
        <input type="hidden" name="loggedin" value="True" >
    </form>
    <ul>
        <li>
            <form action="main.php" method="post">
                <input type="submit" value="Home">
                <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?> >
                <input type="hidden" name="loggedin" value="True" >
            </form>
        </li>
        <li>
           <form action="profile.php" method="post">
                <input type="submit" value="Profile" >
                <input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?> >
                <input type="hidden" name="loggedin" value="True" >
            </form>
        </li>
    </ul>

</body>
</html>
