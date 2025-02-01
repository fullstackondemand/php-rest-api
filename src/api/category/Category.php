<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use Doctrine\ORM\Mapping as ORM;
use RestJS\Entity\AbstractEntity;

#[ORM\Entity]
#[ORM\Table('categories')]
class Category extends AbstractEntity {

    #[ORM\Id]
    #[ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\Column]
    public string $title;

    #[ORM\Column(unique: true)]
    public string $slug;

    #[ORM\Column(nullable: true)]
    public string $description;

    #[ORM\Column(name: "user_id")]
    public string $userId;

    #[ORM\Column(name: "created_at", insertable: false, updatable: false)]
    public string $createdAt;

    #[ORM\Column(name: "updated_at", insertable: false, updatable: false)]
    public string $updatedAt;
}