<?php
session_start();
require_once('Model/Database.php');
// echo "welcome" . $_SESSION['username'];




$database = new Database();
$conn = $database->getConnection();

$userprofile = $_SESSION['username'];
if ($userprofile == true) {
} else {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">

</head>

<body>
    <h2>hello users</h2>
    <?php
    $myalbumlist = "SELECT * FROM gallery_albums";
    $result = $conn->query($myalbumlist);
    while ($album_data = $result->fetch_assoc()) {
        $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . ""); ?>
        <div style="height: 50px; width:350px; margin :5px 0; border:2px solid black;">
            <b>#<?php echo $album_data['album_id'] ?></b>
            <a href="user_view_album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

            </a>
            <!-- <input type="radio" name="status" value="1"> Publish
            <input type="radio" name="status" value="0"> Unpublish
            <input type="submit" value="Update"> -->

            <?php
            // echo "<input type='radio' name='status' value='1' " . ($album_data['publish'] == 1 ? "checked" : "") . ">Publish ";
            // echo "<input type='radio' name='status' value='0' " . ($album_data['publish'] == 0 ? "checked" : "") . ">Unpubl  ish ";
            ?>
            (<?php echo $photos->num_rows; ?>)<br><br>

        </div>
        <?php echo $album_data['description'] ?>
    <?php }
    ?>

    ?>
</body>

</html>