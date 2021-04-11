<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Manager/UserManager.php';


use MiniChat\Entity\User;
use MiniChat\Manager\UserManager;

header('Content-Type: application/json');

$requestType = $_SERVER['REQUEST_METHOD'];
$manager = new UserManager();

switch ($requestType) {
    case 'GET':
        echo getUsers($manager);
        break;
    default:
        break;
}

/**
 * Return the schools list.
 * @param UserManager $manager
 * @return false|string
 */
function getUsers(UserManager $manager): string {
    $response = [];
    $data = $manager->getUsers();
    foreach ($data as $user) {
        $response[] = [
            'id' => $user->getId(),
            'pseudo' => $user->getPseudo(),
            'email' => $user->getEmail(),
            'password' =>$user->getPassword(),
        ];
    }
    return json_encode($response);
}
