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
    <title>SignUP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">


</head>

<body>

    <div class="login-page bg-light">

        <div class="container card  w-100">
            <div class="row">
                <h3>

                    Sign-up
                </h3>
            </div>
            <div class="row">
                <p>
                    Already have an account? <a href="login.php">Sign in</a>
                </p>
            </div>
            <div class="row">
                <div class="col-md-12 ">
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
                                <label>User Type<span class="text-danger text-xs"></span></label>
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

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-4 float-end mt-4">SignUp</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Bootstrap JS -->

</body>

</html>