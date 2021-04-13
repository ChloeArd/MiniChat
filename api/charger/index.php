<?php

use MiniChat\Classes\DB;

require_once "../../assets/php/functions.php";
require_once "../../Classes/DB.php";

// on se connecte à notre base de données

if (!empty($_GET['id'])) { // on vérifie que l'id est bien présent et pas vide
    $bdd = DB::getInstance();

    $id = (int)$_GET['id']; // on s'assure que c'est un nombre entier

    // on récupère les messages ayant un id plus grand que celui donné
    $requete = $bdd->prepare('SELECT * FROM message WHERE id > :id ');
    $requete->execute(array("id" => $id));


    $messages = null;

    // on inscrit tous les nouveaux messages dans une variable
    while ($donnees = $requete->fetch()) {
        $messages .= "<div id='" . $donnees['id'] . "' class='flexColumn messages'>
                <div class='flexRow width100'>
                       <p class='width30 colorBlue bold'>" . $donnees['user_fk'] . "</p>
                       <p class='colorGrey'>" . $donnees['date'] . "</p>
                </div>
                <p class='text'>" . $donnees['message'] . "</p>
            </div>";


        echo $messages; // enfin, on retourne les messages à notre script JS
    }
}

