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

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $sql = "INSERT INTO user VALUES (null, '$pseudo', '$email', '$encryptedPassword')";

          $bdd->exec($sql);
          header("Location: ../../index.php?success=0");
      }
      else {
          header("Location: ../../index.php?error=1");
      }

}