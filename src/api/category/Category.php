<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use Doctrine\ORM\Mapping as ORM;
use RestJS\Class\GetterAndSetter;

#[ORM\Entity]
#[ORM\Table('category')]
class Category extends GetterAndSetter {

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\Column(unique: true)]
    public string $title;

    #[ORM\Column(unique: true)]
    public string $slug;

    #[ORM\Column]
    public string $description;

    #[ORM\Column(name: "author_id")]
    public int $authorId;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    public string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    public string $updatedAt;
}