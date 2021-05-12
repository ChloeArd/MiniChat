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

    $requete = $bdd->prepare("SELECT * FROM user (email, password) VALUES (:email, :password)");
    $requete->bindParam(":email", $email);
    $requete->bindParam(':password', $password);
    $state = $requete->execute();

    if ($state) {
        foreach ($requete->fetch() as $user) {
            $mailUse = $user['email'];
            $pseudoUse = $user['pseudo'];

            if ($mailUse === $email || $pseudoUse === $pseudo) {
                echo "error=0";
            }
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $maj = preg_match('@[A-Z]@', $password);
            $min = preg_match('@[a-z]@', $password);
            $number = preg_match('@[0-9]@', $password);

            if($maj && $min && $number && strlen($password) > 8) {
                $sql = "INSERT INTO user VALUES (null, '$pseudo', '$email', '$encryptedPassword')";

                $bdd->exec($sql);
                echo "success";
            }
            else {
                echo "error=5";
            }

        }
        else {
            echo "error=1";
        }
    }
}
else {
    echo "error=4";
}