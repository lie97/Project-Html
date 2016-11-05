<?php
session_start();
require_once "db.php";
$pesan = null;

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"])) {
	$conn = konek_db();	
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);
	$name = $_POST["name"];
	$email = $_POST["email"];

	$query = $conn ->prepare("Insert into login values(?, ?, ?, ?)");
	$query->bind_param("ssss", $username, $password, $name, $email);
	$hasil = $query->execute();

	if($hasil)
		$pesan ="Register Berhasil";
	else
		$pesan = "Isi Kolom yang Kosong";
} else {
	$pesan = "User/Password tidak dikirim";
} echo ($pesan);
?>