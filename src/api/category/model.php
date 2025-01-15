<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use Doctrine\ORM\EntityManager;
use RestJS\Api\Category\Category as Table;

class Model {

    /** Variables Declaration */
    private $queryBuilder;

    public function __construct(private EntityManager $entityManager) {
        $this->queryBuilder = $entityManager->createQueryBuilder();
    }

    /** Fetch all data */
    public function all(): array {
        return $this->queryBuilder->select('q')->from(Table::class, 'q')->getQuery()->getArrayResult();
    }
}