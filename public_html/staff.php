<!DOCTYPE html>
<html>
        <head>
                <?PHP include 'nav.php'; ?>
                <link rel="stylesheet" href="style.css">
        </head>
        <body>
                <hr>
                <p style="text-align:left">Bob</p>
                <table>
                    <th>Permission</th>
                    <th>None</th>
                    <th>View</th>
                    <th>Modify</th>
                    <tr>
                        <td>Price</td>
                        <form action="">
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                        </form>
                    </tr>
                    <tr>
                        <td>Store Count</td>
                        <form action="">
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                        </form>
                    </tr>
                </table>
                
                <hr>
                <p style="text-align:left">Jane</p>
                <table>
                    <th>Permission</th>
                    <th>None</th>
                    <th>View</th>
                    <th>Modify</th>
                    <tr>
                        <td>Price</td>
                        <form action="">
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                        </form>
                    </tr>
                    <tr>
                        <td>Store Count</td>
                        <form action="">
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                            <td><input type="radio" name="permission"> <br></td>
                        </form>
                    </tr>
                </table>
                <input type="submit" value="Submit">
        </body>
</html>