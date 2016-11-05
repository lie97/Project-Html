<!DOCTYPE html>
<html>
<head>
	<title>Update Music</title>
	<style>
		body{
			background: url("images/edit.jpg");
			background-size: cover;
		}
		.back{
			width:450px;
			height: 200px;
			background-color:#404040;
			margin-top: 150px;
			margin-left: 450px;
			padding-top: 100px;
		}
		.space{
			margin-bottom: 5px;
		}
	</style>
</head>
<?php
$id = $_GET["id"];
?>
<body>
	<form method="post" action="updatemusic.php?id=<?php echo $id?>" enctype="multipart/form-data">
	<div class="back">
	<div class="space">
		<center>
			<label> Nama Penyanyi</label><label>:</label>
			<input type="text" name="penyanyi" placeholder="Artist Name">
		</center>
	</div>
	<div class="space">
		<center>
			<label style="margin-right: 27px;">  Nama Lagu</label><label>:</label>
			<input type="text" name="namalagu" placeholder="Song Name">
		</center>
	</div>
	<div class="space">
			<label style="margin-right: 78px; margin-left: 83px;">File</label><label>:</label>
			<input type="file" name="lagu" placeholder="Song Name">
	</div>
	<div class ="space">
		<center>
			<input type="submit" value="Update" style="margin-left:170px;">
			<button><a href="admin.php" style="text-decoration: none; color:black;">Back</a></button>
		</center>
	</div>
	</div>
	</form>
</body>
</html>