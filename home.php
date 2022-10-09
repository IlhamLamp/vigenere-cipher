<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include 'config.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);

// ambil dari database, simpan di session
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $_SESSION["username"] = $row["username"];
    $_SESSION["nim"] = $row["nim"];
    $_SESSION["email"] = $row["email"];
    $_SESSION["password"] = $row["password"];
}

// test gan
// while ($row = $result->fetch_assoc()) {
//     echo $row['nim'] . "<br>";
// }

// ambil fungsi dari file decrypt.php
include($_SERVER['DOCUMENT_ROOT'] . '/vigenere/key/decrypt.php');
// 

$key = "vigenere";
$dec_res = decipher($_SESSION['password'], $key, false);

?>;

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <!-- Internal CSS -->
    <link href='https://css.gg/log-out.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="container pt-3">
            <div class="row">
                <div class="col-12">
                    <a href="logout.php" class="text-danger text-decoration-none"><i class="gg-log-out"></i>Logout</a>
                    <div class="card border-0 shadow">
                        <div class="text-center pt-5">
                            <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
                            <hr>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="card" style="width: 25rem;">
                                        <img src="images/yae-miko.gif" alt="login_profile">
                                        <blockquote class="blockquote text-center">
                                            <p class="mb-0 p-2">is a method of encrypting alphabetic text by using a series of interwoven Caesar ciphers, based on the letters of a keyword. It employs a form of polyalphabetic substitution.</p>
                                            <footer class="blockquote-footer">Vigenere Cipher, <cite title="Source Title">Wikipedia</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="card-header rounded text-center" style="width: 50rem;">
                                    <div class="card-header rounded bg-success text-light text-center">
                                        PROFILE
                                    </div>
                                    <ul class="list-group list-group-flush p-2">
                                        <li class="list-group-item p-3">Username = <?php echo $_SESSION['username'] ?></li>
                                        <li class="list-group-item p-3">NIM = <?php echo $_SESSION['nim'] ?></li>
                                        <li class="list-group-item p-3">Email = <?php echo $_SESSION['email'] ?></li>
                                        <li class="list-group-item p-3">Password = <?php echo $_SESSION['password'] ?></li>
                                        <li class="list-group-item p-3">
                                            <!-- gunakan fungsi dari script.js -->
                                            <input type="checkbox" class="m-2 p-2" onclick="pwFunction()"> => Password Sebenarnya
                                            <input type="password" class="form-control-plaintext m-2 p-2 text-center" id="show_pw" rows="3" value="<?php echo $dec_res ?>">
                                            <!--  -->
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Optional JavaScript -->
    <script type="text/javascript" async src="https://tenor.com/embed.js"></script>
    <script src="script.js"></script>
</body>

</html>