<?php
declare(strict_types=1);
namespace RestJS\Api\Author;
use Doctrine\ORM\Mapping as ORM;
use RestJS\Trait\GetterAndSetter;

#[ORM\Entity]
#[ORM\Table('author')]
class Author {

    // Get and Set methods
    use GetterAndSetter;

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(unique: true)]
    private string $name;

    #[ORM\Column(unique: true)]
    private string $username;

    #[ORM\Column]
    private string $password;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    private string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    private string $updatedAt;
}