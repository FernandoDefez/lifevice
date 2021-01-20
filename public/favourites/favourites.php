<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="shortcut icon" href="../common/images/pills.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel = "icon" class="fa fa-user" type = "image/x-icon">
    <title>Lifevice</title>
</head>
<body> 

<header>
        <nav>
            <div class="user">
                    <?php
                        session_start();
                        if (isset($_SESSION["USERNAME"])) {
                            echo "<a href='../settings/settings.php' class='fa fa-user'></a>
                            <a class='link' href='../controllers/signoutController/signoutController.php'>Sign Out</a>
                            <div class='popup popup-user'>
                                <p>" . filter_var($_SESSION["USERNAME"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) . "</p>
                            </div>";
                        }
                    ?>
            </div>    
            <div class="logo">
                    <h1>Lifevice</h1>
            </div>
            <div class="heart">
                    <a href="" class="fa fa-heart">
                        <div class="circle">
                            <p id="fav-quant">+9</p>
                        </div>
                        <div class="popup popup-fav"><p>Favourites</p></div>
                    </a>
            </div>
        </nav>
    </header>

    <main>
        <section class="container">

            <div class="box">
                <div class="row routes">
                    <div class="route">
                    </div>
                    <div class="back-to-map">
                        <a href='../controllers/indexController/indexController.php'><span class=" fa fa-arrow-left"></span> Products</a>
                     </div>
                </div>

                <div class="row">
                    <div class="products-container" id="favouritesContainer">
                        <div class="product-card">
                            <div class="product-card-box">
                                <div class="fav">
                                    <a href=""class="fa fa-times"></a>
                                </div>
                                <div class="product-card-desc">
                                    <h3>Nikzon</h3>
                                    <p>Este medicamento sirve para...</p>
                                </div>
                            </div>
                            <div class="product-card-actions">
                                <p>Disponible</p>
                                <p>Isla Mujeres</p>
                                <a class="readmore-button btn" href="../readmore/readmore.php">Leer más</a>
                            </div>
                        </div>
                    </div>
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