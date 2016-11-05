<?php
session_start();
require_once "db.php";
$pesan = null;

if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["email"])) {
	$conn = konek_db();	
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);
	$name = $_POST["name"];
	$email = $_POST["email"];

} else {
	die("data tidak lengkap");
	} 
	$pesan = "User/Password tidak dikirim";
	$query = $conn ->prepare("Insert into login values(?, ?, ?, ?)");
	$query->bind_param("ssss", $username, $password, $name, $email);
	$hasil = $query->execute();

	if($hasil)
		$pesan ="Register Berhasil";
	else
		$pesan = "Isi Kolom yang Kosong";

	echo($pesan);
?>