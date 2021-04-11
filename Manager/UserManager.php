<?php

namespace MiniChat\Manager;

use MiniChat\Classes\DB;
use MiniChat\Entity\User;

class UserManager {

    /**
     * Return a user based on id.
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User {
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id=:id");
        $request->bindValue(':id', $id);
        $request->execute();
        $user_data = $request->fetch();
        $user = new User();
        if ($user_data) {
            $user->setId($user_data['id']);
            $user->setPseudo($user_data['pseudo']);
            $user->setEmail($user_data['email']);
            $user->setPassword($user_data['password']);
        }
        return $user;
    }

    //A VOIR SI UTILISATION DE CETTE FONCTION !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    /**
     * Return a users list.
     * @return array
     */
    public function getUsers(): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user");
        $request->execute();
        $users_response = $request->fetchAll();

        if($users_response) {
            foreach($users_response as $data) {
                $users[] = new User($data['id'], $data['pseudo'], $data['email'], $data['password']);
            }
        }
        return $users;
    }
}