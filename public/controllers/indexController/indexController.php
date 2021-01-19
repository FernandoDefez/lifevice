<?php
    session_start();
    if (isset($_SESSION["phaId"]) && isset($_SESSION["phaName"])) {
        header("Location: ../../home/home.php?pharmacyId=".$_SESSION["phaId"]."&pharmacyName=".$_SESSION["phaName"]);
    }else{
        header("Location: ../../home/home.php");
    }
?>