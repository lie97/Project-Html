<?php 
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["penyanyi"]) && !isset($_GET["namalagu"]) && !isset($_GET["id"]))
	die("Error");

$id = $_GET["id"];

$query = $conn->prepare("select * from music where id=?");
$query->bind_param("s", $id);

$result = $query->execute();

if(!$result)
	die("gagal query");

$rows = $query->get_result();
if($rows->num_rows==0)
	die("Lagu tidak ditemukan");
$post = $rows->fetch_object();
$music = $post->music;
if($music != null && file_exists("music/$music")) {
	//hapus lagu
	unlink("music/$music");
}

$query = $conn->prepare("delete from music where id=?");
$query->bind_param("s",$id);
$result = $query->execute();
if($result)
	echo"<p>Lagu telah dihapus</p>";
else
	echo"<p>Lagu gagal dihapus</p>";
 ?>