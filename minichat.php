<?php
session_start();

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    date_default_timezone_set("Europe/Paris");

    $return = "";
    $id = "";

    if (isset($_GET['success'])) {
        $id = "success";
        switch ($_GET['success']) {
            case '0':
                $return = "Vous êtes bien connecté(e) !";
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
        <title>MiniChat</title>
    </head>
    <body>

    <div id='<?= $id?>' class='modal2 colorWhite'><?= $return?><button id='closeModal' class='buttonClassic'><i class='fas fa-times'></i></button></div>

    <header id="menu">
        <h1 id="miniChat2">MiniChat <i class="fas fa-comments warning"></i></h1>
        <p id="pseudoAccount"><i class="fas fa-user-circle"></i><?= $_SESSION["pseudo"]?></p>
        <button id="disconnection"><i class="fas fa-power-off"></i></button>
    </header>

    <main>
        <div class="input-group mb-3">
            <input id="inputMessage" type="text" class="form-control" placeholder="Envoyer un message..." aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary" type="button" id="buttonSend">Envoyer</button>
            <button class="btn btn-outline-secondary" type="button" id="buttonRefresh"><i class="fas fa-sync-alt"></i></button>
        </div>
        <div id="messagesGroup">

        </div>
        <input hidden type="text" id="inputIdPseudo" value="<?= $_SESSION['id'] ?>">
        <input hidden type="text" id="inputPseudo" value="<?= $_SESSION['pseudo'] ?>">
        <input hidden  type="text" id="inputDate" value="<?= date('Y-m-d H:i:s')?>">
    </main>

    <script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    </body>
    </html>

<?php
}
?>