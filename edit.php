<!DOCTYPE html>
<html>
<head>
	<title>Contoh membaca data database</title>
</head>
<body>
<?php
require_once "db.php"; 

//get data yang akan diedit/update
if (! isset($_GET['penyanyi']) && !isset($_GET['namalagu']))
	die("Lagu tidak ditemukan");

$conn = konek_db();

$penyanyi = $_GET["penyanyi"];
$namalagu = $_GET["namalagu"];
$query = $conn->prepare("select * from music where penyanyi = ? and namalagu=?");
$query->bind_param("ss", $penyanyi, $namalagu);
$result = $query->execute();

if (! $result)
	die("Gagal query");

$rows = $query->get_result();
if ($rows->num_rows == 0)
	die("<p>Lagu tidak ditemukan</p>");

$data = $rows->fetch_object();
?>
	<form method="post" action="update.php?penyanyi= <?php echo $data->id; ?>">
		<div>
			<label>Penyanyi:</label>
			<span><?php echo $data->penyanyi; ?></span>
		</div>

		<div>
			<label>Nama Lagu:</label>
			<input type="text" name="namalagu" value="<?php echo $data->namalagu; ?>">
		</div>
		<div><input type="submit" value="Update"></div>
	</form>

</body>
</html>