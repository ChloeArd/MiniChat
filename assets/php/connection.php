<?php

use MiniChat\Classes\DB;

include "functions.php";
require "../../Classes/DB.php";

if (isset($_POST["email"], $_POST["password"])) {
    $bdd = DB::getInstance();

    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM user WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    // to the password entered by the user
    $user = $stmt->fetch();
    if (password_verify($password, $user['password'])) {
    // If the 2 mdp correspond then we open the session and we store the user's data in a session.
        session_start();
        $_SESSION['id'] = $user['id'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;

        echo "success";
        exit();
    }
    else {
        echo "error=2";
        exit();
    }
}
else {
    echo "error=3";
    exit();
}

