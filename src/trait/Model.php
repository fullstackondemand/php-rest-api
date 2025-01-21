<?php
declare(strict_types=1);
namespace RestJS\Trait;
use Doctrine\ORM\EntityManager;

/** Core Model Functions */
trait Model {

    /** Variables Declaration */
    private $repository;

    public function __construct(private EntityManager $entityManager) {
        $this->repository = $entityManager->getRepository($this->table);
    }

    /** Fetch all data */
    public function fetchAll(): array {
        return $this->repository->findAll();
    }

    /** Fetch data by conditional */
    public function fetchBy($array): array {
        return $this->repository->findBy($array);
    }

    /** Fetch data by id */
    public function fetchById($id): object {
        return $this->repository->find($id);
    }

    /** Delete data by id */
    public function delete(string $id) {
        $data = $this->repository->find($id);
        $this->entityManager->remove($data);
        $this->entityManager->flush();

        return $data;
    }

    /** Update data by id */
    public function update(array $args, string $id) {
        $data = $this->repository->find($id);

        foreach ($args as $key => $value)
            $data->__set($key, $value);

        $this->entityManager->merge($data);
        $this->entityManager->flush();

        return $data;
    }

    /** Insert data */
    public function insert(array $args) {
        $data = new $this->table;

        foreach ($args as $key => $value)
            $data->__set($key, $value);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}