<?php
	// Start XML file, create parent node
	$doc 			= new DOMDocument('1.0', 'utf-8');
	$node 			= $doc->createElement('houses');
	$parnode 		= $doc->appendChild($node);

	// Opens a connection to a MySQL server
	$link 			= mysqli_connect('iota-db.optiklink.com', 'u172759_RgGfESEsRE', '0fLW@N7V^NmRNZLU32VvaI28');
	if( !$link ) {
		die("Error " . mysqli_error($link));
	}
	$db_selected 	= mysqli_select_db($link, "s172759_Dex");

	// Select all the rows in the markers table
	$query = "SELECT * FROM houses WHERE 1";
	$result = mysqli_query($link, $query);

	header("Content-type: text/xml");

	// Iterate through the rows, adding XML nodes for each
	while ($row = mysqli_fetch_assoc($result)){
		// ADD TO XML DOCUMENT NODE
		$node 		= $doc->createElement("house");
		$newnode 	= $parnode->appendChild($node);

		$newnode->setAttribute("name"		, $row['id'] );
		$newnode->setAttribute("address"	, $row['adress']);
		$newnode->setAttribute("owned"		, $row['owned']);
		$newnode->setAttribute("owner"		, $row['owner']);
		$newnode->setAttribute("value"		, $row['value']);
		$newnode->setAttribute("rent"		, $row['rent']);
		$newnode->setAttribute("lat"		, $row['enterX']);
		$newnode->setAttribute("lng"		, $row['enterY']);
		$newnode->setAttribute("exitX"		, $row['exitX']);
		$newnode->setAttribute("exitY"		, $row['exitY']);
		$newnode->setAttribute("exitZ"		, $row['exitZ']);
		$newnode->setAttribute("interior"	, $row['int']);
	}
	$xmlfile = $doc->saveXML();
	echo $xmlfile;
	
	//mysqli_free_result($result);
	//mysqli_close($link);
?>
