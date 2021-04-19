<?php
use MiniChat\Classes\DB;

require_once "../../assets/php/functions.php";
require_once "../../Classes/DB.php";

if (!empty($_GET['id'])) { // We check that the id is present and not empty
    $bdd = DB::getInstance();

    $id = (int)$_GET['id']; // We make sure it's an integer

    // We get the messages with an id greater than the one given
    $requete = $bdd->prepare("SELECT * FROM message WHERE id > :id  ORDER BY id DESC");
    $requete->execute(array('id' => $id));

    $messages = null;

    // We write all the new messages in a variable
    while ($donnees = $requete->fetch()) {
        $idUser_fk = $donnees['user_fk'];
        //We retrieve the user who wrote the message thanks to the id user_fk store in message
        $requete2 = $bdd->prepare("SELECT * FROM user WHERE  id = $idUser_fk");
        $requete2->execute();

        foreach ($requete2->fetchAll() as $donnees2) {
            $messages .= "<div id='" . $donnees['id'] . "' class='flexColumn messages'>
                <div class='flexRow width100'>
                       <p class='width30 colorBlue bold'>" . $donnees2['pseudo'] . "</p>
                       <p class='colorGrey'>" . $donnees['date'] . "</p>
                </div>
                <p class='text'>" . $donnees['message'] . "</p>
            </div>";
        }
        echo $messages; // We return the messages to our JS script
    }
}