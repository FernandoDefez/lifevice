<?php
    session_start();
    if (isset($_SESSION["phaId"]) && isset($_SESSION["phaName"])) {
        header("Location: ../../public/home/home.php?pharmacyId=".$_SESSION["phaId"]."&pharmacyName=".$_SESSION["phaName"]);
    }else{
        header("Location: ../../public/home/home.php");
    }
?>