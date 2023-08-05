<?php
require_once('Model/Database.php');


$database = new Database();
$conn = $database->getConnection();

if (isset($_GET['album_id'])) {
    $album_id = $_GET['album_id'];
    $get_album = $conn->query("SELECT * FROM gallery_albums WHERE album_id = $album_id");
    $album_data = $get_album->fetch_assoc();
} else {
    header("Location: admin.php");
}

if (isset($_POST['upload_photo'])) {

    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "./images/" . $filename;



    // Get all the submitted data from the form
    $sql = "INSERT INTO gallery_photos (album_id, photo_link) VALUES ($album_id, '$filename')";

    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3> Image uploaded successfully!</h3>";
    } else {
        echo "<h3> Failed to upload image!</h3>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8″>
<title><?php echo $album_data['album_name'] ?></title>
</head>
<body>
<?php
$photo_count = $conn->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
?>
<a href=" admin.php">Home</a> | <?php echo $album_data['album_name'] ?> (<?php echo $photo_count->num_rows; ?>)<br><br>
    <form method="post" action="#" enctype="multipart/form-data">
        <label>Add photo to this album:</label><br>
        <input type="file" name="photo" required /> <input type="submit" name="upload_photo" value="Upload" />
    </form>
    <?php
    if (isset($_GET['upload_action'])) {
        if ($_GET['upload_action'] == "success") { ?>
            <br><br>Photo successfully added to this album!<br><br>
    <?php }
    }
    ?>
    <?php
    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
    while ($photo_data = $photos->fetch_assoc()) { ?>
        <img src="images/<?php echo $photo_data['photo_link'] ?>" width="200px" height="200px" />
    <?php }
    ?>
    </body>

</html>