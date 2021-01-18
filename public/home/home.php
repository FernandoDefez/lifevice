<?php

    session_start();

    if(isset($_GET["pharmacyId"]) && isset($_GET["pharmacyName"])){ 
        $_SESSION["phaId"] =  $_GET["pharmacyId"]; 
        $_SESSION["phaName"] = $_GET["pharmacyName"];
    }else{
        header("Location: ../");
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Lifevice</title>
</head>
 
<!-- Modal CSS -->
<?php
if (isset($_SESSION["USERNAME"])) {
    echo 
    "<style>
        .before{
            display:none !important;
        }";
}else{
    echo "<style>";
}
?>
.overlay {
    height: 100%;
    width: 100%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
    display: block;
    display: none;
}
.overlay-content {
    top: 5vh;
    position: relative;
    width: 100%;
}
.overlay .closebtn{
    position: absolute;
    right: 0;
    z-index: 1;
    padding: 2vh 4vw;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block;
    transition: 0.3s;
}
.overlay .closebtn:hover, .overlay .closebtn:focus {
    color: #f1f1f1;
}
</style>

<body onload="getCategories()">

    <!-- Modal -->
    <div id="modal" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeModal()">&times;</a>
        <div class="overlay-content" id="modal-content">

        </div>
    </div>
    
    <!-- Navigation -->
    <header>
        <nav>
            <div class="user">
                    <?php
                        if (isset($_SESSION["USERNAME"])) {
                            echo "<a href='../settings/settings.php' class='fa fa-user'></a>
                            <a class='link' href='../../controllers/signoutController/signoutController.php'>Sign Out</a>
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
                    <?php
                    if (isset($_SESSION["USERNAME"])) {
                        echo "<a href='../favourites/favourites.php' class='fa fa-heart'>
                        <div class='circle'>
                            <p id='fav-quant'>+9</p>
                        </div>
                        <div class='popup popup-fav'>
                            <p>Favourites</p>
                        </div>
                        </a>";
                    }else{
                        echo "";
                    }
                    ?>
            </div>
        </nav>
    </header>
    
    
    <!-- Main Content-->
    <main>

        <section class="container">
            <div class="box">
                <!-- Routing -->
                <div class="row routes">
                    <div class="route">
                        <?php 
                            if (isset($_SESSION["phaName"])){
                                $str = "<a class='link'>". filter_var($_SESSION["phaName"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) ."</a>";
                                echo $str;
                                if (isset($_SESSION["phaId"])){
                                    $str = "<a class='link' id='pharmacyId'>". filter_var($_SESSION["phaId"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH) ."</a>";
                                    echo $str;
                                }else{
                                    header("Location: ../");    
                                }
                            }else{
                                header("Location: ../");
                            }
                        ?>
                    </div>
                    <div class="back-to-map">
                        <a class="" href="../index.php"><span class=" fa fa-arrow-left"></span> Map</a>
                    </div>
                </div>
                <!-- Searching -->
                <div class="row">
                    <div class="search">
                        <div class="input-container">
                            <span class="fa fa-search"></span>
                            <input type="text" id="Search" placeholder="Search" onkeyup="showResult(this.value)">
                        </div>
                    </div>
                    <div class="search slider" id="catSlider">
                        <button type="submit" id="all" name="all" value="all" onclick="enableButton(event, this.value)" class="cat btn selected">Todos</button>
                    </div>
                </div>
                <!-- Product Cards -->
                <div class="row">
                    <div class="products-container" id="productsContainer">
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

<script>

    var catSlider = document.getElementById("catSlider");
    var getPharmacyId = document.getElementById("pharmacyId");
    var search = document.getElementById("Search");

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }

    function openModal(id, name, desc, route, tips, lab) {
        let modal = document.getElementById("modal-content");
        modal.innerHTML = `
        <section class="container">
            <div class="box">
                <div class="row">
                    <div class="product-card readmore-card">
                        <div class="product-card-box">
                            <div class="product-card-image">
                            </div>
                            <div class="product-card-desc">
                                <h3>${name}</h3>
                                <h4>Descripción</h4>
                                <p>${desc}</p>
                                <h4>Vía de Administración</h4>
                                <p>${route}</p>
                                <h4>Recomendaciones</h4>
                                <p>${tips}</p>
                                <h4>Laboratorio</h4>
                                <p>${lab}</p>
                            </div>
                        </div>
                        <div class="product-card-actions">
                            <p>Disponible</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>`;

        document.getElementById("modal").style.display = "block";
    }

    function getCategories(){
        getPharmacyId.style.display = "none";
        let http = new XMLHttpRequest();
        http.onload = function () {
            let result = JSON.parse(this.responseText);
            if(result[0].length>=1){
                for (let i = 0; i < result[0].length; i++) {
                    catSlider.innerHTML +=`<button type="submit" id="${result[0][i].category}" name="${result[0][i].category}" value="${result[0][i].category}"
                    onclick="enableButton(event, this.value)" class="cat btn">${result[0][i].category}</button>`;
                }
            }
        }
        http.open("GET", "../../../farmacias/index.php?pharmacyId="+getPharmacyId.innerText, true);
        http.send();
        setAllProducts();
    }


    function enableButton(evt, category){
        // Get all elements with class="cat" and remove the class "selected"
        links = document.getElementsByClassName("cat");
        search.value="";
        for (i = 0; i < links.length; i++) {
            links[i].className = links[i].className.replace(" selected", "");
        }
        // Show the current tab, and add an "selected" class to the button that opened the tab
        evt.currentTarget.className += " selected";

        let http = new XMLHttpRequest();
        http.onload = function() {
            let result = JSON.parse(this.responseText);
            showProducts(result);
        };
        http.open("GET", "../../../farmacias/index.php?selectedCategory="+category+"&id="+getPharmacyId.innerText, true);
        http.send();
    }


    function setAllProducts(){
        let http = new XMLHttpRequest();
        http.onload = function() {
            let result = JSON.parse(this.responseText);
            showProducts(result);
        };
        http.open("GET", "../../../farmacias/index.php?selectedCategory=all&id="+getPharmacyId.innerText, true);
        http.send();
    }


    function showProducts(result){
        let productsContainer = document.getElementById("productsContainer");
        productsContainer.innerHTML=``;
        if (result[0].length>=1) {
            for (let i = 0; i < result[0].length; i++){
            productsContainer.innerHTML+=`
            <div class="product-card">
                <div class="product-card-box">
                    <div class="fav">
                        <a href="../../controllers/favouritesController/favouritesController.php?id=${result[0][i].productId}"class="fa fa-heart"></a>
                        <div class="before">
                            <a href="../signin/signin.php" class="btn readmore-button selected">Sign In</a>
                            <a>or</a>
                            <a href="../signup/signup.php" class="unselected">Sign Up</a>
                        </div>
                    </div>
                    <div class="product-card-desc">
                        <h3>${result[0][i].productName}</h3>
                        <p>${result[0][i].productDesc.substr(0,100)+"..."}</p>
                    </div>
                </div>
                <div class="product-card-actions">
                        <p>Disponible</p>
                        <a class="readmore-button btn" onclick="
                        openModal('${result[0][i].productId}', '${result[0][i].productName}', '${result[0][i].productDesc}', '${result[0][i].productRoute}',
                        '${result[0][i].productTips}', '${result[0][i].productLab}')">Leer más</a>
                </div>
            </div>`;
        }
        }else{
            console.log("No hay productos que mostrar en esta categoría");
        }
    }


    function showResult(str) {
        let productContainer = document.getElementById("productsContainer");
        if (str.length==0) {
            setAllProducts();
            productContainer.style.display="flex";
            return;
        }
        let http=new XMLHttpRequest();
            http.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                let result = JSON.parse(this.responseText);
                if (result.message!="There is no such product") {
                    showProducts(result);
                    productContainer.style.display="flex";
                }else{
                    productContainer.style.display="none";
                }
            }
        }
        http.open("GET","../../../farmacias/index.php?search="+str+"&phaId="+ getPharmacyId.innerText,true);
        http.send();
    }

</script>

</html>