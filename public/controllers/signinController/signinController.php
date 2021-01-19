<?php

spl_autoload_register(function($class){
    include("../../models/$class/$class.class.php");
});

/**
 * Declaring the variables for each input from signin.php
*/
$email;
$password;

if (isset($_POST['submit'])) {
    $email = $_POST['email'] ? : '';
    $password = $_POST['password'] ? : '';
}

/**
 * Log in
*/
$login =  new User(new Connection);
$login->setEmail($email);
$login->setPassword($password);
$data = $login->signIn();
$name = $data['USER_FULLNAME'];

if($data){
    session_start();
    $_SESSION["USERNAME"] = $data['USER_FULLNAME'];
    header("Location: ../../home/home.php?pharmacyId=".$_SESSION["phaId"]."&pharmacyName=".$_SESSION["phaName"]);
}
else{
    header("Location: ../../signin/signin.php?message=Usuario no existe");
}

?>