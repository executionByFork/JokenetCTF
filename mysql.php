<?php
$mysql_string = getenv('CLEARDB_DATABASE_URL');
$mysql_url = parse_url($mysql_string);

$conn = new mysqli(
	$mysql_url['host'],
	$mysql_url['user'],
	$mysql_url['pass'],
	str_replace("/", "", $mysql_url['path'])
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "mysql";

?>