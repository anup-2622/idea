<?php
session_start();
require_once('Model/Database.php');
$userprofile = $_SESSION['username'];
// echo $_SESSION['username'];
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

if (isset($_POST['upload_photo'])) {

    $filename = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "./images/" . $filename;



    // Get all the submitted data from the form
    $sql = "INSERT INTO gallery_photos (album_id, photo_link) VALUES ($album_id, '$filename')";

    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    // if (move_uploaded_file($tempname, $folder)) {
    //     echo "<h3> Image uploaded successfully!</h3>";
    // } else {
    //     echo "<h3> Failed to upload image!</h3>";
    // }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $album_data['album_name'] ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="login.css"> -->
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <?php
    include 'navbar.php';

    $photo_count = $conn->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
    ?>
    <div class="view-album">

        <div class="container">

            <a href=" admin.php">Home</a> | <?php echo $album_data['album_name'] ?>
            (<?php echo $photo_count->num_rows; ?>)<br><br>
            <form method="post" action="#" enctype="multipart/form-data">
                <label>Add photo to this album:</label><br>
                <input type="file" name="photo" required /> <input type="submit" name="upload_photo" value="Upload" />
            </form>
        </div>


        <?php
        $photos = $conn->query("SELECT * FROM gallery_photos WHERE album_id = $album_id");
        while ($photo_data = $photos->fetch_assoc()) { ?>
            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="images/<?php echo $photo_data['photo_link'] ?>" width="100%" />
                <!-- <img src=" img_nature_wide.jpg" style="width:100%"> -->
                <div class="text">Caption Text</div>
            </div>
        <?php }
        ?>
        <!-- </div> -->
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    </div>
    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
</body>

</html>