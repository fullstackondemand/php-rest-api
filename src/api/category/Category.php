<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use Doctrine\DBAL\Schema\Table;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use RestJS\Trait\GetterAndSetter;

#[Entity]
#[Table('category')]
class Category {

    // Get and Set methods
    use GetterAndSetter;

    #[Id]
    #[Column, GeneratedValue]
    private int $id;

    #[Column(unique: true)]
    private string $name;

    #[Column(unique: true)]
    private string $slug;

    #[Column(unique: true)]
    private string $description;

    #[Column(name: "created_at", insertable: false, updatable: false)]
    private string $createdAt;

    #[Column(name: "updated_at", insertable: false, updatable: false)]
    private string $updatedAt;
}