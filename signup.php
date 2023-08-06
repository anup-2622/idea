<?php

require_once('Model/Database.php');


$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userType = $_POST['userType'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    if ($password == $repassword) {
        $sql_query = $conn->query("INSERT INTO login (name, username, password , userType) VALUES ('$name', '$email', '$password','$userType'   )");

        if ($sql_query) {
            header("location:login.php");
        } else {
            echo "error";
        }
    } else {
        echo '
    <script type="text/javascript">
    alert("password and repassword does not match ");
</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>How To Create</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">


</head>

<body>

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">Register Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="bi bi-bootstrap"></i>
                                    <br>
                                    <a class="text-white" href="login.php">Login</a>
                                </div>
                            </div>
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="#" method="POST" class="row g-4">
                                        <div class="col-12">
                                            <label>Name<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" class="form-control" name="email" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>User Type<span class="text-danger text-xs">'if your do not want
                                                    premium leave
                                                    it '</span></label>
                                            <div class="input-group">
                                                <select name="userType" class="form-control" id="">
                                                    <option value="user" class="form-control">Noramal User</option>
                                                    <option value="premium_user" class="form-control">Premium User
                                                    </option>
                                                    <option value="admin" class="form-control">Amdin</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>Re-Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" name="repassword" placeholder="Enter Re-Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Remember
                                                    me</label>
                                            </div> -->
                                        </div>

                                        <!-- <div class="col-sm-6">
                                            <a href="#" class="float-end text-primary">Forgot Password?</a>
                                        </div> -->

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">SignUp</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <p class="text-end text-secondary mt-3">Bootstrap 5 Login Page Design</p> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->

</body>

</html>