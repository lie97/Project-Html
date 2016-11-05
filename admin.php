<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Music</title>
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
	<table>
		<tr>
			<th>ID</th>
			<th>Nama Penyanyi</th>
			<th>Nama Lagu</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

<?php
while ($row = $rows->fetch_array()) {
	$url_updatemusic = "editmusic.php?id=" . $row['id'];
	$url_delete = "deletemusic.php?id=" . $row['id'];
	echo "<tr>";
	echo "<td>" . $row["id"] . "</td>";
	echo "<td>" . $row['penyanyi'] . "</td>";
	echo "<td>" . $row['namalagu'] . "</td>";
	echo "<td><a href='" . $url_updatemusic . "'><button>Edit</button></a></td>";
	echo "<td><a href='" . $url_delete . "'><button>Delete</button></a></td>";
	echo "</tr>";
}
?>
	</table>
	<button><a href="tambahmusic.html" style="text-decoration: none;color:black;">Add Song</a></button>
</body>
</html>