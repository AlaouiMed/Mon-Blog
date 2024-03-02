<?php

require_once 'Modele/User.php';
require_once 'Vue/Vue.php';

class AuthControleur
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function register($email,$username, $password)
    {
        $this->userModel->register($email,$username, $password);
        header("Location: login.php"); 
        exit();
    }

    public function login($email, $password)
    {
        $user = $this->userModel->login($email, $password);
        if ($user) {
            if ($password === $user['password']) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user['username'];
                header("Location: index.php"); 
                exit();
            } else {
               
                echo "Invalid password.";
            }
        } else {
           
            echo "User not found.";
        }
    }
    public function logout()
    {
   
        $_SESSION = array();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
