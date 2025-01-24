<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event as Event;
use Firebase\JWT\JWT;
use RestJS\Trait\GetterAndSetter;

#[ORM\Entity]
#[ORM\Table('user')]
#[ORM\HasLifecycleCallbacks]
class User {

    // Trait Getter and Setter
    use GetterAndSetter;

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(unique: true)]
    public string $name;

    #[ORM\Column(unique: true)]
    public string $username;

    #[ORM\Column]
    private string $password;

    #[ORM\Column(nullable: true)]
    public string $image;

    #[ORM\Column(nullable: true)]
    public string $logo;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    public string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    public string $updatedAt;

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