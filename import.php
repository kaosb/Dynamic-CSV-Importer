<?php

$link = mysql_connect('localhost', 'root', 'root');

$db = mysql_select_db('wptestinsert',$link) or die(mysql_error($link));

/* Import CSV file into WordPress Custom Post Types, including custom meta fields. */

// Functions:

ini_set("auto_detect_line_endings", true);
ini_set('error_reporting', E_ALL);
$row = 1;
if (($handle = fopen("list.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($row != 1){
        	$post = array(
				'facility_id'    => mysql_real_escape_string($data[0]), //number
				'capacity'       => mysql_real_escape_string($data[1]), //number
				'license_status' => mysql_real_escape_string($data[2]), //string
				'facility_name'  => mysql_real_escape_string($data[3]), //string
				'street_address' => mysql_real_escape_string($data[4]), //string
				'city'           => mysql_real_escape_string($data[5]), //string
				'state'          => mysql_real_escape_string($data[6]), //string
				'zip_code'       => mysql_real_escape_string($data[7]) //number
				);
        	// to print the array
			// print "<pre>";
			// print_r($data);
			// print "</pre>";

			//to insert into mysql table
        	// $sql = "INSERT INTO `post`";
        	// $sql .= " (`".implode("`, `", array_keys($post))."`)";
        	// $sql .= " VALUES (\"".implode("\", \"", $post)."\") ";
        	// $result = mysql_query($sql) or die(mysql_error());

        	//to insert into wordpress
			wp_insert_post( $post );
		}
		$row++;
	}
	fclose($handle);
}



?>