<?php

namespace MiniChat\Manager;

use MiniChat\Classes\DB;
use MiniChat\Entity\User;
use MiniChat\Entity\Message;
use MiniChat\Manager\UserManager;
use PDO;

class MessageManager {

    private UserManager $userManager;

    /**
     * MessageManager constructor.
     */
    public function __construct() {
        $this->userManager = new UserManager();
    }

    /**
     * Return a list of messages.
     * @return array|null
     */
    public function getMessages(): array {
        $messages = [];
        $request = DB::getInstance()->prepare("SELECT * FROM message");
        $request->execute();
        $messages_response = $request->fetchAll();

        if($messages_response) {
            foreach($messages_response as $data) {
                $user = $this->userManager->getUser($data['user_fk']);
                $users[] = new Message($data['id'], $data['message'], $data['date'], $user);
            }
        }

        return $users;
    }

    /**
     * Fetch provided Message ( id ).
     * @param int $id
     * @return Message
     */
    public function getMessage(int $id): Message {
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE id=:id");
        $request->bindValue(':id', $id);
        $request->execute();
        $message_data = $request->fetch();
        $message = new Message();
        if($message_data) {
            $message->setId($message_data['id']);
            $message->setMessage($message_data['message']);
            $message->setDate($message_data['date']);
            $user = $this->userManager->getUser($message_data['user_fk']);
            $message->setUser($user);
        }
        return $message;
    }

    /**
     * Add a new message into the database.
     * @param $message
     * @param $date
     * @param $user
     * @return bool
     */
    public function addMessage(string $message,string $date,int $user): bool{
        $request = DB::getInstance()->prepare("
            INSERT INTO message (message, date, user_fk)
              VALUES (:message, :date, :user_fk)
        ");
        $request->bindParam(':message', $message);
        $request->bindParam(':date', $date);
        $request->bindParam(':user_fk', $user, PDO::PARAM_INT);
        $request->execute();
        return intval(DB::getInstance()->lastInsertId()) !== 0;
    }
}