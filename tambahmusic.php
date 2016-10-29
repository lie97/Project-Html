<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "db.php";

if (isset($_POST["penyanyi"]) && isset($_POST["namalagu"]) && isset($_POST["music"])) {
    $penyanyi  = $_POST["penyanyi"];
    $namalagu = $_POST["namalagu"];
    $music = $_POST["music"];

    $conn = konek_db();

    $query = $conn->prepare("insert into music values(?, ?, ?)");

    $query->bind_param("ssb", $penyanyi, $namalagu, $music);

    $result = $query->execute();

    if (! $result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Music Berhasil Ditambahkan.</p>";
} else {
    echo "<p>Music Gagal Ditambahkan</p>";
}
?>
</body>
</html>
