<?php
require_once('Model/Database.php');


$database = new Database();
$conn = $database->getConnection();

if (isset($_POST['submit_album'])) {
    $album = $_POST['album_name'];
    $album_des = $_POST['description'];
    $add_album = $conn->query("INSERT INTO gallery_albums (album_name , description) VALUES ('$album', '$album_des')");
    if ($add_album) {
        header("Location: admin.php?add_album_action=successfull");
    } else {
        echo "error";
    }
}
