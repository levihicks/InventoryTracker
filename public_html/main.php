
<?PHP include 'user.php'; ?>
<!DOCTYPE html>

<html lang="en-US">
    <head>
        <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="styles/optionsStyle.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet"> 
        <title>Options</title>
        <?PHP if ($login) : ?>
        <?PHP include 'nav.php'; ?>
    </head>
    <body>
    	<p> Welcome <?php echo $name; ?> </p>
    	<hr>
    	<h3>Search</h3>
    	<form action="search.php" method="post">
        <!form onsubmit="window.location.href='Results.html';return false;">
    		<input type="text" name="itemName" placeholder="Find Item...">
		
		<input type="submit" value="Search">
		
		<label>Sort by:</label>
		<select name="sorts">
			<option value="relevance">Relevance</option>
			<option value="price">Price</option>
			<option value="name">Item Name</option>
			<option value="on_hand">Quantity</option>
		</select>
		
		<input type="hidden" name="user" value=<?PHP echo $_POST["user"]; ?>>
    		<input type="hidden" name="loggedin" value="True">
    	</form>
    <?PHP endif; ?>

    </body>
</html>
