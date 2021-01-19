<?php
    session_start();

    if(isset($_GET["id"])){
        echo $_GET["id"];
        echo $_SESSION["phaId"];
        echo $_SESSION["phaName"];
        echo $_SESSION["USERNAME"];
    }

?>