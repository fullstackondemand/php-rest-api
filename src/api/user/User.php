<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use Doctrine\ORM\Mapping as ORM;
use RestJS\Class\AuthEntity;

#[ORM\Entity]
#[ORM\Table('user')]
#[ORM\HasLifecycleCallbacks]
class User extends AuthEntity {

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(unique: true)]
    public string $name;

    #[ORM\Column(unique: true)]
    public string $username;

    #[ORM\Column]
    protected string $password;

    #[ORM\Column(nullable: true)]
    public string $image;

    #[ORM\Column(nullable: true)]
    public string $logo;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    public string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    public string $updatedAt;
}