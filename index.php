<?php

$return = "";
$id = "";

if (isset($_GET['error'])){
    $id = "error";
    switch ($_GET['error']){
        case '0':
            $return = "Email ou pseudo deja utilisé !";
            break;
        case '1':
            $return = "L'email n'est pas valide !";
            break;
        case '2':
            $return = "Aucun compte associé à cette email ou ce mot de passe";
            break;
        case '3':
            $return = "Problème de connexion.";
            break;
        case '4':
            $return = "Problème d'inscription.";
            break;
        case '5':
            $return = "Le mot de passe ne contient pas de majuscule ou de chiffres ou de minuscule ou plus petit que 10 caractères";
            break;
    }
}
elseif (isset($_GET['success'])) {
    $id = "success";
    switch ($_GET['success']) {
        case '0':
            $return = "Vous êtes bien inscrit(e) !";
            break;
        case '1':
            $return = "Vous êtes bien déconnectée(e) !";
            break;
    }
}


?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>Inscription / Connexion</title>
</head>
<body>

    <div id='<?= $id?>' class='modal2 colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>
    <h1 id="miniChat">MiniChat <i class="fas fa-comments warning"></i></h1>

    <main id="connection_registration">
        <!-- Button for connection -->
        <button id="buttonConnection" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConnexion">Connexion</button>

        <!-- Modal for connection -->
        <div class="modal fade" id="modalConnexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Connexion <i class="fas fa-user-circle"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="./assets/php/connection.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-primary" value="Se connecter">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Button for registration -->
        <button id="buttonRegistration" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRegistration">Inscription</button>

        <!-- Modal for registration -->
        <div class="modal fade" id="modalRegistration" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inscription <i class="fas fa-user-circle"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="./assets/php/registration.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="pseudo" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <input type="submit" class="btn btn-primary" value="S'inscrire">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>