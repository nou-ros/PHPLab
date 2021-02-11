<?php
require('config/config.php');
require('config/db.php');

$id = $_GET["id"];

$sql = "SELECT * FROM imggallery WHERE id=$id";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res)) {
    $img = $row["imgFullName"];
}

unlink($img);

$sql = "DELETE FROM imggallery WHERE id=$id";
mysqli_query($conn, $sql);
header('Location: home.php?imageDeleted');
