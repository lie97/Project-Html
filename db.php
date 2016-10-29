<?php
require_once "config.php";

function konek_db() {
	global $DB;

	$conn = mysqli_connect($DB['host'], $DB['user'], $DB['password']);
	if (! $conn)
		die("<p>Database connection fail.</p>");

	$db = mysqli_select_db($conn, $DB['db']);
	if (! $db)
		die("<p>Can't access database.</p>");

	return $conn;
}
?>