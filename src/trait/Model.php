<?php
declare(strict_types=1);
namespace RestJS\Trait;
use Doctrine\ORM\EntityManager;

/** Core Model Functions */
trait Model {

    /** Variables Declaration */
    private $queryBuilder;

    public function __construct(private EntityManager $entityManager) {
        $this->queryBuilder = $entityManager->createQueryBuilder();
    }

    /** Fetch all data */
    public function fetch(): array {
        return $this->queryBuilder->select('q')->from($this->table, 'q')->getQuery()->getArrayResult();
    }

    /** Delete data by id */
    public function delete(string $id)  {
        return $this->queryBuilder->delete($this->table, 'q')->where("q.id = :id")->setParameter(':id', $id)->getQuery()->execute();
    }

    /** Update data by id */
    public function update(array $args, string $id) {
        $result = 0;

        foreach ($args as $key => $value):
            if ($key == 'password')
                $value = password_hash($value, PASSWORD_BCRYPT);

            $result = $this->queryBuilder->update($this->table, "q")->set("q.$key", ":$key")->where("q.id = :id")->setParameter(":$key", $value)->setParameter('id', $id)->getQuery()->execute();
        endforeach;

        return $result;
    }

    /** Insert data */
    public function insert(array $args) {
        $data = new $this->table;

        foreach ($args as $key => $value):
            if ($key == 'password')
                $value = password_hash($value, PASSWORD_BCRYPT);

            $data->__set($key, $value);
        endforeach;

        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}