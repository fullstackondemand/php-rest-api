<?php
declare(strict_types=1);
namespace RestJS\Model;

use Doctrine\ORM\EntityManager;

/** Abstract Model Functions */
abstract class AbstractModel {

    /** Create Repository from Entity */
    private $repository;

    /** Entity Class String */
    private $entity;

    /** Abstract Function for Set Entity Class String */
    abstract protected function setEntity();

    public function __construct(private EntityManager $entityManager) {
        $this->entity = $this->setEntity();
        $this->repository = $entityManager->getRepository($this->entity);
    }

    /** Find All Data */
    public function findAll(): array {
        return $this->repository->findAll();
    }

    /** Find Data by Conditional */
    public function findBy(array $args): array {
        return $this->repository->findBy($args);
    }

    /** Filter Data by Conditional */
    public function filter(array $args): object {
        return $this->repository->findOneBy($args);
    }

    /** Find Data by Id */
    public function findById($id): object {
        return $this->repository->find($id);
    }

    /** Delete Data by Id */
    public function delete(array $args) {
        $row = $this->repository->findOneBy($args) ?? null;

        if ($row):
            $this->entityManager->remove($row);
            $this->entityManager->flush();

            return $row;
        endif;
    }

    /** Update Data by Id */
    public function update(array $data, array $args) {
        $row = $this->repository->findOneBy($args) ?? null;

        if ($row):
            foreach ($data as $key => $value)
                $row->__set($key, $value);

            $this->entityManager->merge($row);
            $this->entityManager->flush();

            return $row;
        endif;
    }

    /** Insert Data */
    public function insert(array $data): object {
        $row = new $this->entity;

        foreach ($data as $key => $value)
            $row->__set($key, $value);

        $this->entityManager->persist($row);
        $this->entityManager->flush();

        return $row;
    }
}