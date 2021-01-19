<?php
session_start();
if (isset($_GET["message"])){
    echo $_GET["message"];
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
    
    <!-- Navigation -->
    <header>
        <nav>
            <div class="user">
                <a href='../controllers/indexController/indexController.php' class='fa fa-arrow-left'></a>
                <div class="popup popup-user"><p>Back</p></div>
            </div>
            <div class="logo">
                    <h1>Lifevice</h1>
            </div>
            <div class="user">
                <a href="../signin/signin.php" class="btn sign-in-link">Sign In</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <section class="container">
            <div class="box">
                <div class="row">
                    <!-- Sign Up Form -->
                    <form action="../controllers/signupController/signupController.php" method="POST" class="sign-card">
                        <div class="title">
                            <h1>Sign Up</h1>
                        </div> 
                        <p>Fullname</p>
                        <div class="input-container">
                            <span class="fa fa-user"></span>
                            <input type="text" placeholder="Enter your fullname" name="fullname" required autofocus>
                        </div>
                        <p>E-mail</p>
                        <div class="input-container">
                            <span class="fa fa-envelope"></span>
                            <input type="text"  placeholder="Enter your e-mail" name="email" required>
                        </div>
                        <p>Password</p>
                        <div class="input-container">
                            <span class="fa fa-lock"></span>
                            <input type="password" placeholder="Enter your password" name="password" required>
                        </div>
                        <p>Confirm Password</p>
                        <div class="input-container">
                            <span class="fa fa-lock"></span>
                            <input type="password" placeholder="Confirm your password" name="confirmed_password" required>
                        </div>
                        <div class="info-sign-up">
                            <input type="checkbox" name="accepted_terms" id="" required>
                                <p>I agree to the Lifevice 
                                    <a href="" class="link">Terms</a> and 
                                    <a href="" class="link">Privacy Policy</a>
                                </p>
                        </div>
                        <div class="submit-container">
                            <button type="submit" class="btn" name="submit">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
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