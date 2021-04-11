<?php
session_start();
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

<header id="menu">
    <h1 id="miniChat2">MiniChat <i class="fas fa-comments warning"></i></h1>
    <p id="pseudoAccount"><i class="fas fa-user-circle"></i> <?= $_SESSION["pseudo"]?></p>
    <a href="assets/php/disconnection.php" id="disconnection"><i class="fas fa-power-off"></i></a>
</header>

<main>
    <div id="messagesGroup">
        <table class="table table-striped table-hover">
            <tbody>
            <?php
            for ($i = 0; $i < 50; $i++) {
                echo "
                <tr>
                    <th scope='row' class='width20 colorBlue'>" . $_SESSION['pseudo'] . " : </th>
                    <td class='text'>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto aspernatur aut 
                    corporis dolore harum inventore minus, molestias, nam nesciunt nihil nostrum optio porro qui quia quibusdam quos repudiandae sunt, voluptate?</td>
                    <td class='width20 colorGrey'>Vendredi 9 avril à 10:58</td>
                </tr>
                ";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Envoyer un message..." aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn btn-outline-primary" type="button" id="button-addon2">Envoyer</button>
    </div>
</main>

<script src="https://kit.fontawesome.com/351e9300a0.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="assets/js/app.js"></script>

</body>
</html>