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
		$html = '<form action=\'' . $_SERVER['PHP_SELF'] . '\' method ="post"> ';
		//start drop-down list
		$html .= '<select name ="' . $name . '"';
		$html .= ' onchange="this.form.submit()">';
		//blank first entry
		$html .= ' <option value="">Select...</option> ';
		//add each option to list
		foreach($array as $option){
			$html .= ' <option value="' . $option . '">';
			$html .= $option . '</option>';
		}
		$html .= '</select> </form>';
		return $html;
	}
	//query into a one-dimensional array
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
		echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
		foreach($permissions as $permission)
		{
			$html = $permission . '<input type="checkbox" name="' . $uname . $permission .
					'" value="' . $uname. $permission . '"';
			//check if set
			$query = "SELECT command FROM permissions WHERE employee = '" . $uname .
					 "' AND command = '" . $permission ."'";
			$result = (query_1D_array($query, $conn));
			if ($result){
				$html .= 'checked="checked"';
			}
			$html .= '><br>';
			echo $html;
		}
		echo '<input type="submit" value="Submit">';
		echo "</form>";
	}
?>