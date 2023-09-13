<!--  661288825625-4rj79v0h26i4b50ls477bfu8eh4h1l8s.apps.googleusercontent.com     -->
<!-- client Id  -->
<!-- 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 -->
<!-- client secret  -->
<?php

session_start();


require_once('Model/Database.php');

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_query = "SELECT * FROM `login` WHERE  username = '" . $username . "' and password = '" . $password . "'";
    $result = mysqli_query($conn, $sql_query);

    $row = mysqli_fetch_array($result);


    if ($password == $row['password']) {


        if ($row['userType'] == "user") {
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = $row['userType'];

            header("location:user.php");
        } else if ($row['userType'] == "admin") {
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = $row['userType'];
            header("location:admin.php");
        } else if ($row['userType'] == "premium_user") {
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = $row['userType'];
            header('location:user.php');
        } else {
            echo "username or password not ";
        }
    } else { ?>
        <!-- <script>
            window.alert("Password Incorrect!!");
        </script> -->
<?php
    }
}


//  Google Login Authentication 


// // require 'config.php';
// if (isset($_SESSION['login_id'])) {
//     header('Location: user.php');
//     exit;
// }
// require 'google-api/vendor/autoload.php';
// // Creating new google client instance
// $client = new Google_Client();
// // Enter your Client ID
// $client->setClientId('661288825625-4ro94pijcfpq9i07ro3dmlqkbqprvs6q.apps.googleusercontent.com');
// // Enter your Client Secrect
// $client->setClientSecret('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');
// // Enter the Redirect URL
// $client->setRedirectUri('http://localhost/idea/login.php');
// // Adding those scopes which we want to get (email & profile Information)
// $client->addScope("email");
// $client->addScope("profile");
// if (isset($_GET['code'])) :
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     if (!isset($token["error"])) {
//         $client->setAccessToken($token['access_token']);
//         // getting profile information
//         $google_oauth = new Google_Service_Oauth2($client);
//         $google_account_info = $google_oauth->userinfo->get();

//         // Storing data into database
//         $id = mysqli_real_escape_string($conn, $google_account_info->id);
//         $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
//         $email = mysqli_real_escape_string($conn, $google_account_info->email);
//         $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);
//         // checking user already exists or not
//         $get_user = mysqli_query($conn, "SELECT `google_id` FROM `users` WHERE `google_id`='$id'");
//         if (mysqli_num_rows($get_user) > 0) {
//             $_SESSION['login_id'] = $id;
//             header('Location: user.php');
//             exit;
//         } else {
//             // if user not exists we will insert the user
//             $insert = mysqli_query($conn, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$id','$full_name','$email','$profile_pic')");
//             if ($insert) {
//                 $_SESSION['login_id'] = $id;
//                 header('Location: user.php');
//                 exit;
//             } else {
//                 echo "Sign up failed!(Something went wrong).";
//             }
//         }
//     } else {
//         header('Location: login.php');
//         exit;
//     }

// else :
//     // Google Login Url = $client->createAuthUrl(); 
//     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">


</head>

<body>

    <div class="login-page bg-light">


        <div class="container card w-25">
            <div class="row border">
                <h3>Login</h3>

            </div>
            <div class="row  border">
                <p>Don't have account? <a href="signup.php">sign up</a></p>
            </div>
            <div class="row border">
                <div class="col-md-12 pe-0">
                    <div class="form-left h-100 py-5 px-5">
                        <form action="#" method="POST" class="row g-4">
                            <div class="col-12">
                                <label>Username<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                    <input type="text" class="form-control" name="username" placeholder="Enter Username">
                                </div>
                            </div>

                            <div class="col-12">
                                <label>Password<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                    <label class="form-check-label" for="inlineFormCheck">Remember
                                        me</label>
                                </div>
                            </div>


                            <div class="col-5">
                                <button type="submit" class="btn btn-primary px-4 float-end mt-4">login</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <div class="row border text-center">
                <span>
                    or
                </span>
            </div>
            <div class="row border text-center">
                <div class="col-4 p-2"><i class="fa-brands fa-google-plus-g fa-2x" style="color: #b31b00;"></i></div>
                <div class="col-4 p-2"><i class="fa-brands fa-facebook fa-2x" style="color: #0e52c8;"></i></div>
                <div class="col-4 p-2"><i class="fa-brands fa-github fa-2x" style="color: #000000;"></i></div>
            </div>
        </div>




        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <img class="w-100 login-img" src="./image/image-cave-logo.png" alt="">
                                    <br>
                                    <a class="btn btn-outline-info" style="color: white;" href="signup.php">Sign Up</a>
                                </div>
                            </div>
                        </div>

                    </div>
               
                </div>
            </div>
        </div> -->
    </div>

    <!-- Bootstrap JS -->

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

</html>



<?php
// endif;
?>