<?php

use MiniChat\Classes\DB;

include "functions.php";
require "../../Classes/DB.php";

if (isset($_POST["pseudo"], $_POST["password"], $_POST["email"])) {
    $bdd = DB::getInstance();

    $pseudo = sanitize($_POST["pseudo"]);
    $password = sanitize($_POST["password"]);
    $email = trim($_POST["email"]);

    $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);


    $requete = $bdd->prepare("SELECT * FROM user WHERE email = '" . $email . "' OR pseudo = '" . $pseudo ."'");
    $state = $requete->execute();

    if ($state) {
        foreach ($requete->fetchAll() as $user) {
            $mailUse = $user['email'];
            $pseudoUse = $user['pseudo'];
        }
        if ($mailUse === $email || $pseudoUse === $pseudo) {
            echo "Email ou pseudo deja utilisé !";
            header("Location: ../../index.php?error=0");
        }
        else {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $maj = preg_match('@[A-Z]@', $password);
                $min = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);

                if($maj && $min && $number && strlen($password) > 10) {
                    $sql = "INSERT INTO user VALUES (null, '$pseudo', '$email', '$encryptedPassword')";

                    $bdd->exec($sql);
                    header("Location: ../../index.php?success=0");
                }
                else {
                    header("Location: ../../index.php?error=5");
                }

            }
            else {
                echo "L'email n'est pas valide !";
                header("Location: ../../index.php?error=1");
            }
        }
    }
}
else {
    header("Location: ../../index.php?error=4");
}