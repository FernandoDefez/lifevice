<?php
    
    spl_autoload_register(function($class){
        include("../../models/$class/$class.class.php");
    });    

    /**
     * Declaring the variables for each input from signup.php
     */
    $fullname;
    $email;
    $password;
    $confirmed_password;
    $accepted_terms;


    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'] ? : '';
        $email = $_POST['email'] ? : '';
        $password = $_POST['password'] ? : '';
        $confirmed_password = $_POST['confirmed_password'] ? : '';
        $accepted_terms = $_POST['accepted_terms'] ? : 0;
    }

    echo $fullname;
    echo $email;
    echo $password;
    echo $confirmed_password;
    echo $accepted_terms;
    echo"<br>";

    
    $user =  new User(new Connection);

    /**
     * Signup
    */
    $user->setFullname($fullname);
    $user->setEmail($email);
    $user->cryptPass($password);
    $user->signUp();

    header("Location: ../../views/signin/signin.php");
?>