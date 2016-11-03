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
			<th>Nama Produk</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>

<?php
while ($row = $rows->fetch_array()) {
	$url_updatemusic = "updatemusic.html?id=" . $row['id'] . "&penyanyi=" . $row['penyanyi'] . "&namalagu=" .  $row['namalagu'];
	$url_delete = "deletemusic.php?id=" . $row['id'] . "&penyanyi=" . $row['penyanyi'] . "&namalagu=" .  $row['namalagu'];
	echo "<tr>";
	echo "<td>" . $row["id"] . "</td>";
	echo "<td>" . $row['penyanyi'] . "</td>";
	echo "<td>" . $row['namalagu'] . "</td>";
	echo "<td><a href='" . $url_updatemusic . "'><button>Edit</button></a>";
	echo "<a href='" . $url_delete . "'><button>Delete</button></a></td>";
	echo "</tr>";
}
?>
	</table>
</body>
</html>