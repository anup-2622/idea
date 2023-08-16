<?php
session_start();
require_once('Model/Database.php');
$userprofile = $_SESSION['username'];
if ($userprofile == true) {
} else {
    header('localhost:login.php');
}



$database = new Database();
$conn = $database->getConnection();


if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
    $get_album = $conn->query("SELECT * FROM gallery_albums WHERE album_id = $album_id");
    $album_data = $get_album->fetch_assoc();
} else {
    header("Location: admin.php");
}



$sql = "DELETE FROM `gallery_albums` WHERE album_id = $album_id";
if (mysqli_query($conn, $sql)) {
    echo "Deleted data successfully\n";
} else {
}
