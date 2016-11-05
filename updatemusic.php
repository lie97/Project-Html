<?php
require_once "db.php";

$conn = konek_db();

if (!isset($_POST["penyanyi"]) && !isset($_POST["namalagu"]))
die("data tidak lengkap");

$id = $_GET["id"];
$penyanyi = $_POST["penyanyi"];
$namalagu = $_POST["namalagu"];
$query = $conn->prepare("select * from music where id=?");
$query->bind_param("s", $id);
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
			copy ($music['tmp_name'], 'music/' . $file_music);
		}
	}
} else {
	$file_music = $file->music;
}

if (!$id)
	die("Error");


$query = $conn->prepare("update music set penyanyi=?, namalagu=?, music=? where id=?");
$query->bind_param("ssss", $penyanyi, $namalagu, $music,$id);
$result = $query->execute();

if ($result)
	echo "<p>Music Terupdate</p>";
else
	echo "<p>Gagal Mengupdate Music</p>";
?>