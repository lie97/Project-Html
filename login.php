<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<?php
require_once "db.php";
//jika sudah login ; dan belum logout, redirect ke content
if(isset($_SESSION["username"]))
	header("location: content.php");

//jika belum login, dan belum ada kirim username dan password
//tampilkan form login
if (!isset($_POST["username"]) ||
	!isset($_POST["password"])) {
//jika belum login, dan sudah kirim username dan password
// cek apakah username dan password valid
} else{
	$username = $_POST["username"];
	$password = sha1($_POST["password"]);

	$conn = konek_db();
	$query = $conn->prepare("select * from login where user=? and password=?");
	$query->bind_param("ss", $username, $password);
	$result = $query->execute();
//cek username dan password valid , jika valid loginkan user dan 
//redirect ke content
	if ($result) {
		$res = $query->get_result();
		if ($res->num_rows == 1) {
			//login user
			$_SESSION["username"] = $username;
			//redirect ke content
			header("location: content.php");
			//jika username/paswword salah ditampilkan warning
		} if(empty($_POST["username"])) {
			echo "<p>Enter Username!</p>";
			return false;
		} if(empty($_POST["password"])) {
			echo "<p>Enter Password!<p>";
			return false;
		}
	} else {
		echo "<h2>Sistem bermasalah.</h2>";
		echo "<p>Coba Lagi Beberapa Saat</p>";
	}
}
?>
</body>
</html>