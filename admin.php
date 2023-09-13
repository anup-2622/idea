<?php

session_start();


require_once('Model/Database.php');
// echo "welcome" . $_SESSION['userType'];

$database = new Database();
$conn = $database->getConnection();



$userprofile = $_SESSION['username'];
if ($userprofile == true) {
} else {
    header('location:login.php');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $publish = $_POST['publish'];

    $pulish_query = "UPDATE gallery_albums SET publish = '$publish' WHERE  album_id = '$id'";

    $result = mysqli_query($conn, $pulish_query);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- <link rel="stylesheet" href="login.css"> -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php
    include 'navbar.php';
    ?>
    <main class="main-pannel">
        <div class="container">
            <div class="card">
                <h3 class="text-dark">Create Album</h3>
                <form method="post" action="add-album.php">
                    <label>Add New Album:</label><br>
                    <div class="row">
                        <div class="col-3 mb-3">
                            <label for="ablum_title" class="form-label">Album Title</label>
                            <input type="text" class="form-control" id="ablum_des" name="album_name" placeholder="Album Title">
                        </div>

                        <div class="col-3 mb-3">
                            <label for="album_des" class="form-label">Album Description</label>
                            <input type="text" class="form-control" id="ablum_title" name="description" placeholder="Album Description">
                        </div>
                        <div class="col-1 ">
                            <br>
                            <input type="submit" class="btn btn-primary" name="submit_album" value="Add" />
                        </div>
                    </div>
                </form><br>
            </div>
        </div>


        <div class="grid-container container  mt-2">

            <?php


            $myalbumlist = "SELECT * FROM gallery_albums";
            $result = $conn->query($myalbumlist);

            while ($album_data = $result->fetch_assoc()) {
                $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = " . $album_data['album_id'] . ""); ?>
                <div class="grid-item">

                    <div class="album-icon ">
                        <i class="fa-solid fa-folder fa-5x"></i>

                    </div>
                    <div class="album-data">

                        <!-- <b>#<?php echo $album_data['album_id'] ?></b> -->
                        <a href="view-album.php?album_id=<?php echo $album_data['album_id'] ?>"><?php echo $album_data['album_name'] ?>

                        </a>


                        (<?php echo $photos->num_rows; ?>)<br><br>

                        <?php echo $album_data['description'] ?>
                    </div>
                    <div>
                        <form action="<?php $_PHP_SELF ?>" method="post">

                            <select class="btn border mb-2 " name="publish" id="">
                                <?php if ($album_data['publish'] == 1) { ?>

                                    <option class="btn" value="1">Publish</option>
                                    <option class="btn" value="0">Unpublish</option>

                                <?php } else { ?>
                                    <option class="btn" value="0">Unpublish</option>
                                    <option class="btn" value="1">Publish</option>
                                <?php

                                } ?>
                            </select>
                            <input type="text" class="d-none" value="<?php echo $album_data['album_id'] ?>" name="id">


                            <input type="submit" name="" class=" btn btn-primary mt-2" value="Update">
                            <a class="btn btn-danger" href="delete-album.php?album_id=<?php echo $album_data['album_id'] ?>"> <i class="fa-solid fa-trash" style="font-size:24px"></i> </a>
                        </form>
                    </div>
                </div>
            <?php }
            ?>
        </div>

    </main>
</body>

</html>