<!DOCTYPE html>
<html>
<head>
	<title>Cara membaca data dari database</title>
</head>
<body>
<?php
require_once "db.php";

$conn = konek_db();

//eksekusi query untuk tarik data dari database
$query = $conn->prepare("select * from music");
$result = $query->execute();

if (! $result)
	die("Gagal entry");

//tarik data ke result set
$rows = $query->get_result();
?>
<?php
while ($row = $rows->fetch_array()) {
	echo "<tr>";
	echo "<td>" . $row['penyanyi'] . "</td>";
	echo "<td>" . $row['namalagu'] . "</td>";
	echo "<td>" . $row['music'] . "</td>";
	echo "<td><a href='" . $url_edit . "'><button>Edit</button></a>";
	echo "<a href='" . $url_delete . "'><button>Delete</button></a></td>";
	echo "</tr>";
}
?>
</body>
</html>