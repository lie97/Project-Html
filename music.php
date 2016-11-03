<!DOCTYPE html>
<html>
<head>
<title>Music</title>
<style>
body{
      background: url("images/blur.jpg");
      background-size: cover;
    }
.navbar{
  width: 800px;
  height: 200px;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color:#800000;
}

li {
    float: left;
}

li a {
    display: block;
    color: #bfbfbf;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #cc3300;
}

.center{
      height: 10em;
      position: relative;
      margin-left: 20%;
      transform: translate(-50%,);
    }

span.logo{
      font-size: 50px;
      font-style: italic;
      font-family: "Comic Sans MS", cursive, sans-serif;
      color: #bfbfbf;
      margin-left: 15%;
    }

table{
  width:74%;
  color: white  ;
  border:block;
  margin-top: -160px;
  border-collapse: collapse;
}
th, td{
  border:1px solid red;
  text-align:center;
}

td:nth-child(3){
  border-right: none;
  text-align: center;
}
 td:nth-child(4){
  border-left: none;
  text-align: left;
}
.a{
  border-radius: 5px;
  padding: 5px;
}
</style>
</head>
<body>
<div class="center">
  <span class="logo">Welcome to Gangsta</span> <br>
    <div class="navbar">
      <ul>
        <li><a href="#home">Music</a></li>
        <li><a href="#news">Video</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <?php
        require_once "db.php";

        $conn = konek_db();

        //eksekusi query untuk tarik data dari database
        $query = $conn->prepare("select * from music");
        $result = $query->execute();

        if (! $result)
          die("Gagal entry");

        //tarik data ke result set
        $rows = $query->get_result();
      ?>
    </div>
  <table>
    <tr>
      <th>Artist</th>
      <th>Song Title</th>
      <th colspan="2">Music</th>
    </tr>

    <?php
      while ($row = $rows->fetch_array()) {
        $url_music = "music/" . $row["music"];
        echo "<tr>";
        echo "<td>" . $row['penyanyi'] . "</td>";
        echo "<td>" . $row['namalagu'] . "</td>";
        echo "<td>" . "<audio controls>";
        echo "<source src=\"$url_music\" type=\"audio/mpeg\">";
        echo "</audio> </td> <td><a href=\"$url_music\" download><button class=\"a\">Download</button></a>" . "</td>";
        echo "</tr>";
      }
   ?>
  </table>
</div>
</body>
</html>