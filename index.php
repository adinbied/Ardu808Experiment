<?php
$datatoinsert = file_get_contents('php://input');
$db_host = '<dbhost>';
$db_username = '<dbuser>';
$db_password = '<dbpass>';
$db_name = '<dbname>';
mysql_connect( $db_host, $db_username, $db_password) or die(mysql_error());
mysql_select_db($db_name); 
$parts = explode(",", $datatoinsert);
$time = $parts[2];
$lat = $parts[3];
$longi = $parts[4];
$alt = $parts[5];
$speed = $parts[6];

mysql_query("INSERT INTO `gpsdata` (time, lat, longi, alt, speed) 
                               VALUES ('$time', '$lat', '$longi', '$alt', '$speed') ") 
    or die(mysql_error());  
echo($parts[4]);
?>
