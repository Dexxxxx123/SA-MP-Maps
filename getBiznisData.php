<?php
	// Start XML file, create parent node
	$doc 			= new DOMDocument('1.0', 'utf-8');
	$node 			= $doc->createElement('bizzes');
	$parnode 		= $doc->appendChild($node);

	// Opens a connection to a MySQL server
	$link 			= mysqli_connect('127.0.0.1', 'server', 'pass');
	if( !$link ) {
		die("Error " . mysqli_error($link));
	}
	$db_selected 	= mysqli_select_db($link, "server");

	// Select all the rows in the markers table
	$query = "SELECT * FROM bizzes WHERE 1";
	$result = mysqli_query($link, $query);

	header("Content-type: text/xml");

	// Iterate through the rows, adding XML nodes for each
	while ($row = mysqli_fetch_assoc($result)){
		// ADD TO XML DOCUMENT NODE
		$node 		= $doc->createElement("biznis");
		$newnode 	= $parnode->appendChild($node);

		$newnode->setAttribute("name"		, ( $row['id'] - 1 ) );
		$newnode->setAttribute("message"	, $row['message']);
		$newnode->setAttribute("owner"		, $row['owner']);
		$newnode->setAttribute("owned"		, $row['owned']);
		$newnode->setAttribute("type"		, $row['type']);
		$newnode->setAttribute("value"		, $row['buyprice']);
		$newnode->setAttribute("level"		, $row['levelneeded']);
		$newnode->setAttribute("entercost"	, $row['entrancecost']);
		$newnode->setAttribute("lat"		, $row['entrancex']);
		$newnode->setAttribute("lng"		, $row['entrancey']);
	}
	$xmlfile = $doc->saveXML();
	echo $xmlfile;
?>