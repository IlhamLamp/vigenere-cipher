<?php

include 'config.php';

error_reporting(0);

session_start();

// ambil fungsi dari file encrypt.php
include($_SERVER['DOCUMENT_ROOT'] . '/vigenere/key/encrypt.php');
// 

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

// register
if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // key encrypt
    $key = "vigenere";
    $enc_res = encipher($password, $key, true);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, nim, email, password)
					VALUES ('$username', '$nim', '$email', '$enc_res')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Wow! User Registration Completed.')</script>";
                $username = "";
                $email = "";
                $nim = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Something Wrong Went.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Already Exists.')</script>";
        }
    } else {
        echo "<script>alert('Password Not Matched.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
</head>

<body>
    <section>
        <div class="container mt-2 pt-4">
            <div class="row">
                <div class="col-12 col-sm-7 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="text-center pt-5">
                            <img src="images/login_profile.png" alt="login_profile" width="100" height="100">
                            <h1>REGISTER</h1>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" class="login-email">
                                <div class="input-group">
                                    <input class="form-control m-2 p-2" name="username" rows="3" placeholder="username" value="<?php echo $username; ?>" required></input>
                                </div>
                                <div class="input-group">
                                    <input class="form-control m-2 p-2" name="nim" rows="3" placeholder="nim" value="<?php echo $nim; ?>" required></input>
                                </div>
                                <div class="input-group">
                                    <input type="email" class="form-control m-2 p-2" name="email" rows="3" placeholder="email" value="<?php echo $email; ?>" required></input>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control m-2 p-2" name="password" id="show_pw" rows="3" placeholder="password" value="<?php echo $_POST['password']; ?>" required></input>
                                    <!-- gunakan fungsi dari script.js -->
                                    <input type="checkbox" class="m-2 p-2" onclick="pwFunction()"></input>
                                    <!--  -->
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control m-2 p-2" name="cpassword" id="show_cpw" rows="3" placeholder="confirm password" value="<?php echo $_POST['cpassword']; ?>" required></input>
                                    <!-- gunakan fungsi dari script.js -->
                                    <input type="checkbox" class="m-2 p-2" onclick="cpwFunction()"></input>
                                    <!--  -->
                                </div>
                                <div class="text-center m-3">
                                    <input type="submit" name="submit" value="Sign Up" class="btn btn-primary">
                                </div>
                                <div class="text-center">
                                    <p>
                                        Have an account? <a href="index.php" class="nav-link">Login here</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="script.js"></script>

</body>

</html>