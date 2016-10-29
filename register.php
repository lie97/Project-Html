<?php
require "db.php";
$pesan = null;
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["name"])) {
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);
	$name = $_POST["name"];
	$email = $_POST["email"];

	$conn = konek_db();

	$query = $conn ->prepare("Insert into login values(?, ?, ?, ?)");
	$query->bind_param("ssss", $username, $password, $name, $email);

	$hasil = $query->execute();

	if($hasil)
		$pesan ="User berhasil ditambahkan";
	else
		$pesan = "Gagal tambah user";
} else {
	$pesan = "User/Password tidak dikirim";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register User</title>
</head>
<body>
<p><?php echo $pesan; ?></p>
</body>
</html>