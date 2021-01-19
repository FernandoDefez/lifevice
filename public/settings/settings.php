<?php
session_start();

if(!isset($_SESSION["phaId"]) && !isset($_SESSION["phaName"])){ 
    header("Location: ../");
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
                    <a href='../../controllers/indexController/indexController.php' class='fa fa-arrow-left'></a>
                    <div class="popup popup-user"><p>Back</p></div>
            </div>    
            <div class="logo">
                    <h1>Lifevice</h1>
            </div>
            <div class="heart">
                    <a href="../favourites/favourites.php" class="fa fa-heart">
                        <div class="circle">
                            <p id="fav-quant">+9</p>
                        </div>
                        <div class="popup popup-fav"><p>Favourites</p></div>
                    </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>

        <section class="container">
            <div class="box">
                <!-- Settings -->
                <div class="row setting-card">
                    <div class="sign-card">
                        <div class="title">
                            <h1>Profile</h1>
                        </div>
                        <div class="setting-content">
                            <p class="fullname">
                                <?php
                                    if (isset($_SESSION["USERNAME"])) {
                                        echo filter_var($_SESSION["USERNAME"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                                    }
                                ?>
                            </p>
                            <p>Change e-mail</p>
                            <div class="input-container">
                                <span class="fa fa-envelope"></span>
                                <input type="password" class="" placeholder="account@gmail.com">
                            </div>
                            <p>Change password</p>
                            <div class="input-container">
                                <span class="fa fa-lock"></span>
                                <input type="password" class="neu-ins" placeholder="password">
                            </div>
                        </div>
                        <div class="submit-container ">
                            <button type="submit" class="btn">Update</button>
                        </div>
                    </div>  
                </div>
            </div>
        </section>
    </main>

    <!-- Footer-->
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