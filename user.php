<?php

session_start();


require_once('Model/Database.php');
// echo "welcome" . $_SESSION['username'];

$database = new Database();
$conn = $database->getConnection();

$userType = $_SESSION['userType'];

$userprofile = $_SESSION['username'];
if ($userprofile == true) {
} else {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="login.css"> -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <div class="admin">
        <div class="grid-container container  mt-2">

            <?php


            $myalbumlist = "SELECT * FROM gallery_albums";
            $result = $conn->query($myalbumlist);

            if ($userType == 'user') {
                while ($album_data = $result->fetch_assoc()) {


                    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id  = '' "); ?>
                    <!-- $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . "");  -->

                    <div class="grid-item">

                        <div class="album-icon ">
                            <i class="fa-solid fa-folder fa-5x"></i>

                        </div>
                        <div class="album-data  ">

                            <!-- <b>#<?php echo $album_data['album_id'] ?></b> -->
                            <a href="view-album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

                            </a>

                            <?php
                            // echo "<input type='radio' name='status' value='1' " . ($album_data['publish'] == 1 ? "checked" : "") . ">Publish ";
                            // echo "<input type='radio' name='status' value='0' " . ($album_data['publish'] == 0 ? "checked" : "") . ">Unpubl  ish ";
                            ?>
                            (<?php echo $photos->num_rows; ?>)<br><br>

                            <?php echo $album_data['description'] ?>
                        </div>

                    </div>
                <?php
                }
            } else {
                while ($album_data = $result->fetch_assoc()) {


                    // $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id  = 0 "); 
                    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . ""); ?>
                    <div class="grid-item">

                        <div class="album-icon ">
                            <i class="fa-solid fa-folder fa-5x"></i>

                        </div>
                        <div class="album-data  ">

                            <!-- <b>#<?php echo $album_data['album_id'] ?></b> -->
                            <a href="view-album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

                            </a>


                            (<?php echo $photos->num_rows; ?>)<br><br>

                            <?php echo $album_data['description'] ?>
                        </div>

                    </div>
            <?php
                }
            }
            ?>
        </div>

    </div>
</body>

</html>