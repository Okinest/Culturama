<?php

namespace controllers;

use models\User;

function login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getByEmail($email);

        if($user && password_verify($password, $user->getPassword())){
            session_start();

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['email'] = $user->getEmail();

            exit();
        }
    } else{
        $message = "Invalid Credentials. Try again.";
    }

    require_once ('home.php');
}