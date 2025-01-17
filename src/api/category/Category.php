<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use Doctrine\ORM\Mapping as ORM;
use RestJS\Trait\GetterAndSetter;

#[ORM\Entity]
#[ORM\Table('category')]
class Category {

    // Get and Set methods
    use GetterAndSetter;

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(unique: true)]
    private string $title;

    #[ORM\Column(unique: true)]
    private string $slug;

    #[ORM\Column]
    private string $description;

    #[ORM\Column(name: "author_id")]
    private int $authorId;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    private string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    private string $updatedAt;
}