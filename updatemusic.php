<!DOCTYPE html>
<html>
<head>
	<title>Contoh update data ke database</title>
</head>
<body>
<?php
require_once "db.php";

$conn = konek_db();

if (!isset($_GET["id"]) && !isset($_GET["penyanyi"]) && !isset($_GET["namalagu"]))
	die("Error");

$id = $_GET["id"];
$penyanyi = $_GET["penyanyi"];
$namalagu = $_GET["namalagu"];
$query = $conn->prepare("select * from music where id=? and penyanyi=? and namalagu=?");
$query->bind_param("sss", $id, $penyanyi, $namalagu);
$result = $query->execute();

if (! $result)
	die("Gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
	die("Lagu Tidak Ditemukan");

$file = $rows->fetch_object();
if($_FILES["lagu"]["error"] == 0) {

	$music = $file->music;
	if($music != null && file_exists("music/$music")) {
		unlink("music/$music");
	}

	$file_music = '';
	if(isset($_FILES["music"])) {
		if($_FILES["music"]["error"] == 0) {
			$music = $_FILES["music"];

			$extension = new SplFileInfo($music['name']);
			$extension = $entexsion->getExtension();
			$file_gambar = $nama . ' . ' . $extension;
			copy ($music['tmp_name'], 'music/' . $file_gambar);
		}
	}
} else {
	//tetap file gambar yang lama
	$file_gambar = $file->music;
}

if (!isset($_POST["id"]))
	die("Lagu Tidak Ditemukan");

$id = $_POST["id"];

$query = $conn->prepare("update music set penyanyi=?, namalagu=?, music=? where id=?");
$query->bind_param("sss", $penyanyi, $namalagu, $music);
$result = $query->execute();

if ($result)
	echo "<p>Music Terupdate</p>";
else
	echo "<p>Gagal Mengupdate Music</p>";
?>
</body>
</html>