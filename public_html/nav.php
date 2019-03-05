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

    <ul>
        <li>
            <form action="main.php" method="post">
                <input type="submit" value="Home">
            </form>
        </li>
        <li>
           <form action="profile.php" method="post">
                <input type="submit" value="Profile" >
            </form>
        </li>
                <li>
           <form action="staff.php" method="post">
                <input type="submit" value="Staff" >
            </form>
        </li>
    </ul>



