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


    if (isset($_POST['submit']))
    {
        if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmed_password']) && isset($_POST['accepted_terms'])) 
        {
            if ($_POST['password'] == $_POST['confirmed_password']) {
                $fullname = $_POST['fullname'] ? : '';
                $email = $_POST['email'] ? : '';
                $password = $_POST['password'] ? : '';
                $confirmed_password = $_POST['confirmed_password'] ? : '';
                $accepted_terms = $_POST['accepted_terms'] ? : 0;

                #Signup
                $user =  new User(new Connection);
                $user->setFullname($fullname);
                $user->setEmail($email);
                $user->cryptPass($password);
                if($user->signUp()){
                    header("Location: ../../public/signin/signin.php");
                }else{
                    header("Location: ../../public/signup/signup.php?message='Ocurrió un problema al registrarse'");        
                }
            }
            else{
                header("Location: ../../public/signup/signup.php?message='Contraseñas no coinciden'");
            }
        }else{
            header("Location: ../../public/signup/signup.php?message='Faltó un dato por insertar'");
        }
    }
?>