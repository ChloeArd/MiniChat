<?php

use MiniChat\Classes\DB;

include "functions.php";
require "../../Classes/DB.php";

if (isset($_POST["email"], $_POST["password"])) {
    $bdd = DB::getInstance();

    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM user (email) VALUES (:email)");
    $stmt->bindParam(':email', $email);

    $stmt->execute();

    foreach ($stmt->fetch() as $user) {
    // I check that the password encrypted on my database that I retrieved using the '$ user [' password ']' loop corresponds
    // to the password entered by the user
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
}
else {
    echo "error=3";
    exit();
}

