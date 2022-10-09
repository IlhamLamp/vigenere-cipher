<?php

include 'config.php';

session_start();

error_reporting(0);

// ambil fungsi dari file encrypt.php
include($_SERVER['DOCUMENT_ROOT'] . '/vigenere/key/encrypt.php');
// 

if (isset($_SESSION['username'])) {
    header("Location: home.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // mengenkripsi password dengan key agar sama dengan database
    $key = "vigenere";
    $dec_res = encipher($password, $key, true);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$dec_res'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: home.php");
    } else {
        echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Required meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <section>
        <div class="container mt-3 pt-5">
            <div class="row">
                <div class="col-12 col-sm-7 col-md-6 m-auto">
                    <div class="card border-0 shadow">
                        <div class="text-center pt-5">
                            <img src="images/login_profile.png" alt="login_profile" width="100" height="100">
                            <h1>LOGIN</h1>
                        </div>
                        <div class=" card-body">
                            <form action="" method="POST" class="login-email">
                                <div class="input-group">
                                    <input class="form-control m-2 p-2" name="email" rows="3" placeholder="email" value="<?php echo $email; ?>" required></input>
                                </div>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" class="form-control m-2 p-2" name="password" id="show_pw" rows="3" placeholder="password" value="<?php echo $_POST['password']; ?>" required></input>
                                    <!-- gunakan fungsi dari script.js -->
                                    <input type="checkbox" class="m-2 p-2" onclick="pwFunction()"></input>
                                    <!--  -->
                                </div>
                                <div class="text-center m-3">
                                    <input type="submit" name="submit" value="Login" class="btn btn-primary">
                                </div>
                                <div class="text-center">
                                    <p>
                                        Don't have an account? <a href="register.php" class="nav-link">Register here</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-muted text-center">
                            Coded with <span style="color: Tomato;"> <i class="fa fa-heart"></i> </span> by Ilham Nur Utomo
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>