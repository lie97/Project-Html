<?php 
require_once "db.php";

$conn = konek_db();

if(! isset($_GET["penyanyi"]) && !isset($_GET["namalagu"]))
	die("Lagu Tidak Ditemukan");

$penyanyi = $_GET["penyanyi"];
$namalagu = $_GET["namalagu"];

$query = $conn->prepare("select * from music where penyanyi=? and namalagu=?");
$query->bind_param("ss",$penyanyi, $namalagu);

$result = $query->execute();

if(!$result)
	die("gagal query");

$rows = $query->get_result();
if($rows->num_rows==0)
	die("Lagu tidak ditemukan");
$post = $rows->fetch_object();
$music = $post->music;
if($music != null && file_exists("music")) {
	//hapus image
	unlink("music");
}

$query = $conn->prepare("delete from music where penyanyi=? and namalagu=?");
$query->bind_param("ss",$penyanyi, $namalagu);
$result = $query->execute();
if($result)
	echo"<p>Lagu telah dihapus</p>";
else
	echo"<p>Lagu gagal dihapus</p>";
 ?>