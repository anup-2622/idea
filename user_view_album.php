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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <?php
    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
    while ($photo_data = $photos->fetch_assoc()) { ?>
        <img src="images/<?php echo $photo_data['photo_link'] ?>" width="200px" height="200px" />
    <?php }
    ?>
</body>

</html>