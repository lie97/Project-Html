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

	if(!isset($name) || !isset($username) || !isset($password) || !isset($confirmpassword) == "") {
    	$pesan = "You did not fill out the required fields.";
	}if($hasil)
		$pesan ="Register Berhasil";
	else
		$pesan = "Isi Kolom yang Kosong";
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
<button type="button"><a href = "music.html">Go to Music Page</a></button>
<button type="button"><a href = "music.html">Go to Music Page</a></button>
</body>
</html>