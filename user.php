<?php

session_start();


require_once('Model/Database.php');
// echo "welcome" . $_SESSION['username'];

$database = new Database();
$conn = $database->getConnection();

$userType = $_SESSION['userType'];
// echo $userType;

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

            if ($userType == 'premium_user') {
                $myalbumlist = "SELECT * FROM gallery_albums ";
                $result = $conn->query($myalbumlist);
                while ($album_data = $result->fetch_assoc()) {
                    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . ""); ?>
                    <div class="grid-item">

                        <div class="album-icon ">
                            <!-- <h5>NORMAL USER</h5> -->
                            <i class="fa-solid fa-folder fa-5x"></i>

                        </div>
                        <div class="album-data  ">

                            <!-- <b>#<?php echo $album_data['album_id'] ?></b> -->
                            <a href="user_view_album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

                            </a>

                            <?php
                            ?>
                            (<?php echo $photos->num_rows; ?>)<br><br>

                            <?php echo $album_data['description'] ?>
                        </div>

                    </div>
                <?php }
            } else if ($userType == 'user') {
                $myalbumlist = "SELECT * FROM gallery_albums where publish = 0";
                $result = $conn->query($myalbumlist);
                while ($album_data = $result->fetch_assoc()) {
                    $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . ""); ?>
                    <div class="grid-item">

                        <div class="album-icon ">
                            <i class="fa-solid fa-folder fa-5x"></i>

                        </div>
                        <div class="album-data  ">

                            <!-- <b>#<?php echo $album_data['album_id'] ?></b> -->
                            <a href="user_view_album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

                            </a>

                            <?php
                            ?>
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