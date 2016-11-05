<?php
require_once "db.php";

if (!empty($_POST["penyanyi"]) && !empty($_POST["namalagu"]) && !empty($_POST["idlagu"])) {
    $idlagu = $_POST["idlagu"];
    $penyanyi  = $_POST["penyanyi"];
    $namalagu = $_POST["namalagu"];

    $conn = konek_db();
    $file_music = '';

    if (isset($_FILES["music"])) {
        $music = $_FILES["music"];
        if ($_FILES["music"]["error"] == 0) {

            $extension = new SplFileInfo($music['name']);
            $extension = $extension->getExtension();
            $file_music = $penyanyi . ' - ' . $namalagu . '.' . $extension;
            copy ($music['tmp_name'], 'music/' . $file_music);  
        }
    }  
    $query = $conn->prepare("insert into music values(?, ?, ?, ?)");

    $query->bind_param("ssss", $idlagu, $penyanyi, $namalagu, $file_music);

    $result = $query->execute();

    if (! $result)
        die("<p>Proses query gagal.</p>");

    
    echo "<p>Music Berhasil Ditambahkan.</p>";
} else {
    echo "<p>Music Gagal Ditambahkan</p>";
}
?>