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

if (isset($_POST["penyanyi"]) && isset($_POST["namavideo"]) && isset($_POST["video"])) {
    $penyanyi  = $_POST["penyanyi"];
    $namavideo = $_POST["namavideo"];
    $video = $_POST["video"];

    $conn = konek_db();
    
    $query = $conn->prepare("insert into video(penyanyi,namavideo,video) values(?, ?, ?)");

    $query->bind_param("sss", $penyanyi, $namavideo, $video);

    $result = $query->execute();

    if (!$result)
        die("<p>Proses query gagal.</p>");

    echo "<p>Video Berhasil Ditambahkan.</p>";
} else {
    echo "<p>Video Gagal Ditambahkan</p>";
}
?>
</body>
</html>
