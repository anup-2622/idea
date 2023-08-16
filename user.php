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

<!-- Google Authentication  -->
<?php
if (!isset($_SESSION['login_id'])) {
    header('Location: login.php');
    exit;
}
$id = $_SESSION['login_id'];
$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `google_id`='$id'");
if (mysqli_num_rows($get_user) > 0) {
    $user = mysqli_fetch_assoc($get_user);
} else {
    header('Location: logout.php');
    exit;
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
        <div class="_img">
            <img src="<?php echo $user['profile_image']; ?>" alt="<?php echo $user['name']; ?>">
        </div>
        <div class="_info">
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>
            <a href="logout.php">Logout</a>
        </div>

    </div>
</body>

</html>