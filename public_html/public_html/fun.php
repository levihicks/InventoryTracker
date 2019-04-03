<?PHP
//function to build html table from array of rows
	function build_table($array)
	{
		// start table
		$html = '<table align="center">';
		// header row
		$html .= '<tr>';
		foreach($array[0] as $key=>$value){
				$html .= '<th>' . htmlspecialchars($key) . '</th>';
			}
		$html .= '</tr>';
		// data rows
		foreach( $array as $key=>$value){
			$html .= '<tr>';
			foreach($value as $key2=>$value2){
				$html .= '<td>' . htmlspecialchars($value2) . '</td>';
			}
			$html .= '</tr>';
		}
		// finish table and return it
		$html .= '</table>';
		return $html;
	}
	//build a dropdown list from and array with a name
	function build_dropdown($array, $name)
	{
		//start drop-down list
		echo "\r\n<select name =\"" . $name . "\"";
		echo ' onchange="this.form.submit()">';
		//blank first entry
		echo "\r\n <option value=\"\">";
        echo "Select...</option> \r\n";
		//add each option to list
		foreach($array as $option){
			echo ' <option value="' . $option . '">';
			echo $option . "</option>\r\n";
		}
        echo "</select>\r\n";
	}
	//query into a one-dimensional array for simple non-injected queries
	function query_1D_array($query, $conn)
	{
		$sqlquery=$conn->prepare($query);
        $sqlquery->execute();
        for($i = 0; $row = $sqlquery->fetch(); $i++)
        {
            $array[$i] = $row[0];
        }
		return $array;
	}
	// build and precheck boxes for each permission for a single user
    function permissions_checkbox_form ($uname, $permissions, $conn)
	{
        //start form
		echo "\r\n<form action=\"" .$_SERVER['PHP_SELF']. "\" method=\"post\" >\r\n";
        //make each checkbox
		foreach($permissions as $permission)
		{
			$html = "$permission <input type=\"checkbox\" name='".$uname.$permission."' value=\"Yes\"";
			//check if pre-checked
			$query = "SELECT command FROM permissions WHERE employee = '" . $uname .
					 "' AND command = '" . $permission ."'";
			$result = (query_1D_array($query, $conn));
			if ($result){
				$html .= ' checked="checked"';
			}
            //end checkbox
			$html .= '><br>';
			echo $html;
            echo "\r\n";
		}
        //post updated user on submission
        echo <<<HTML
		<input type="hidden" value="True" name="permissionChangeFlag">
		<input type="hidden" value="$uname"  name="changedUser">
		<input type="submit" value="Submit">
	</form>\r\n
HTML;
	}
?>