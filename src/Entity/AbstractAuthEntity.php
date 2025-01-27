<?php
declare(strict_types=1);
namespace RestJS\Entity;

use Firebase\JWT\JWT;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event as Event;

/** Abstract Authorization Entity Functions */
class AbstractAuthEntity extends AbstractEntity {

    #[ORM\PrePersist]
    public function prePersist() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    #[ORM\PreUpdate]
    public function preUpdate(Event\PreUpdateEventArgs $event) {
        $passwordModify = $event->hasChangedField('password') ?? false;

        if ($passwordModify)
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    /** Verify Password Function */
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    /** Generate Access Token Function */
    public function generateAccessToken() {
        return JWT::encode([
            'id' => $this->id,
            'username' => $this->username
        ], $_ENV['ACCESS_TOKEN_SECRET'], 'HS256');
    }
}