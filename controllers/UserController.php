<?php
use models\User;

function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $existingUser = User::getByEmail($email);
        $isValid = User::isPasswordStrong($username, $password);

        if ($existingUser) {
            $mailTaken = "L'adresse e-mail existe déjà.";
        } elseif(!$isValid) {
            $weakPassword = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre, et ne doit pas contenir le nom d'utilisateur.";
        }else {
            $user = User::create($username, $email, $password);
            if ($user) {
                $message = "Inscription réussie !";
            } else {
                $message = "Erreur lors de l'inscription.";
            }
        }
    }
    require_once ('views/user/register.php');
}
function login(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::getByEmail($email);

        if($user && password_verify($password, $user->getPassword())){

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();
            header('Location: /');
            exit();
        } else{
            $message = "Invalid Credentials. Try again.";
        }
    }

    require_once ('views/user/login.php');
}
function logout(){
    session_unset();
    session_destroy();
    header('Location: /');
    exit();
}