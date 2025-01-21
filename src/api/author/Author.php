<?php
declare(strict_types=1);
namespace RestJS\Api\Author;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event as Event;
use RestJS\Trait\GetterAndSetter;

#[ORM\Entity]
#[ORM\Table('author')]
#[ORM\HasLifecycleCallbacks]
class Author {

    // Get and Set Methods
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
}