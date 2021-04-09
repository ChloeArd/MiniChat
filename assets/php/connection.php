<?php

use APP\Classes\DB;

include "functions.php";
require "../../Classes/DB.php";

if (isset($_POST["pseudo"], $_POST["password"])) {
    $bdd = DB::getInstance();

    $pseudo = sanitize($_POST['pseudo']);
    $password = sanitize($_POST['password']);

    // I get the name of the user
    $stmt = $bdd->prepare("SELECT * FROM user WHERE pseudo = '$pseudo'");

    $stmt->execute();

    foreach ($stmt->fetchAll() as $user) {
// I check that the password encrypted on my database that I retrieved using the '$ user [' password ']' loop corresponds to the password entered by the user
        if (password_verify($password, $user['password'])) {
        // If the 2 mdp correspond then we open the session and we store the user's data in a session.
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $user['email'];

            header("Location: ../../minichat.php");
        }
        else {
            echo '<body onLoad="alert(\'Membre non reconnu !\')">';
            echo "Aucun compte associé à ce nom d'utilistaur ou mot de passe";
            echo '<meta http-equiv="refresh" content="0;URL=../../index.php">';
        }
    }
}

