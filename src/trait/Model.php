<?php
declare(strict_types=1);
namespace RestJS\Trait;

use Doctrine\ORM\EntityManager;

/** Core Model Functions */
trait Model {

    /** Create Repository from Table */
    private $repository;

    public function __construct(private EntityManager $entityManager) {
        $this->repository = $entityManager->getRepository($this->table);
    }

    /** Find All Data */
    public function findAll(): array {
        return $this->repository->findAll();
    }

    /** Find Data by Conditional */
    public function findBy($array): array {
        return $this->repository->findBy($array);
    }

    /** Find Data by Id */
    public function findById($id): object {
        return $this->repository->find($id);
    }

    /** Delete Data by Id */
    public function delete(string $id) {
        $data = $this->repository->find($id);
        $this->entityManager->remove($data);
        $this->entityManager->flush();

        return $data;
    }

    /** Update Data by Id */
    public function update(array $args, string $id) {
        $data = $this->repository->find($id);

        foreach ($args as $key => $value)
            $data->__set($key, $value);

        $this->entityManager->merge($data);
        $this->entityManager->flush();

        return $data;
    }

    /** Insert Data */
    public function insert(array $args) {
        $data = new $this->table;

        foreach ($args as $key => $value)
            $data->__set($key, $value);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}