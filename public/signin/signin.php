<?php
session_start();
if (isset($_GET["message"])){
    echo $_GET["message"];
}
if (isset($_SESSION["USERNAME"])){
    if (isset($_SESSION["phaId"]) && isset($_SESSION["phaName"])) {
        header("Location: ../home/home.php?pharmacyId=".$_SESSION["phaId"]."&pharmacyName=".$_SESSION["phaName"]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="shortcut icon" href="../common/images/pills.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Lifevice</title>
</head>
<body> 

    <header>
        <nav>
            <div class="user">
                <a href='../../controllers/indexController/indexController.php' class='fa fa-arrow-left'></a>
                <div class="popup popup-user"><p>Back</p></div>
            </div>
            <div class="logo">
                    <h1>Lifevice</h1>
            </div>
            <div class="user">
                <a href="../signup/signup.php" class="btn sign-in-link">Sign Up</a>
            </div>
        </nav>
    </header>


    <main>
        <section class="container">
            <div class="box">
                <div class="row">
                    <form action="../../../controllers/signinController/signinController.php" method="POST" class="sign-card">
                        <div class="title"><h1>Sign In</h1></div>
                            <p>E-mail</p>
                        <div class="input-container">
                            <span class="fa fa-envelope"></span>
                            <input type="text"  placeholder="Enter your e-mail" required autofocus name="email">
                        </div>
                        <p>Password</p>
                        <div class="input-container">
                            <span class="fa fa-lock"></span>
                            <input type="password" placeholder="Enter your password" required name="password">
                        </div>
                        <div class="submit-container">
                            <button type="submit" class="btn" name="submit">Sign In</button>
                        </div>
                        <div class="info-sign-in">
                            <p>Don´t have an account? <a href="../signup/signup.php" class="link"> Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <div class="information">
                <p>&copy; 2020 Lifevice</p>
                <a href="">Terms</a>
                <a href="">Privacy</a>
                <a href="">Security</a>
                <a href="">FAQ's</a> 
            </div>
        </div>
    </footer>
</body>
</html>