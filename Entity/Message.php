<?php

namespace MiniChat\Entity;

use MiniChat\Entity\User;

class Message {

    private ?int $id;
    private ?string $message;
    private ?string $date;
    private ?User $user;

    public function __construct(int $id = null, string $message = null, string $date = null, User $user = null) {
        $this->id = $id;
        $this->message = $message;
        $this->date = $date;
        $this->user = $user;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void {
        $this->date = $date;
    }

    /**
     * @return \MiniChat\Entity\User|null
     */
    public function getUser(): ?\MiniChat\Entity\User {
        return $this->user;
    }

    /**
     * @param \MiniChat\Entity\User|null $user
     */
    public function setUser(?\MiniChat\Entity\User $user): void {
        $this->user = $user;
    }
}