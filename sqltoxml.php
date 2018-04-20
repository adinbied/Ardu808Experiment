<?php
$db_host = '<dbhost>';
$db_username = '<dbuser>';
$db_password = '<dbpass>';
$db_name = '<dbname>';
// Start XML file, create parent node

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

// Opens a connection to a MySQL server

$connection=mysql_connect ($db_host, $db_username, $db_password);
if (!$connection) {  die('Not connected : ' . mysql_error());}

// Set the active MySQL database

$db_selected = mysql_select_db($db_name, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table

$query = "SELECT * FROM gpsdata WHERE time LIKE '%<currentyear>%'";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("time",$row['time']);
  $newnode->setAttribute("lat",$row['lat']);
  $newnode->setAttribute("longi", $row['longi']);
  $newnode->setAttribute("alt", $row['alt']);
  $newnode->setAttribute("speed", $row['speed']);
}

echo $dom->saveXML();

?>
