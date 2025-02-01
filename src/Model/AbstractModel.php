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

    /** Find Data by Id */
    public function findById($id) {
        return $this->repository->find($id);
    }

    /** Delete Data by Id */
    public function delete(array $args) {
        $data = $this->repository->findBy($args)[0] ?? null;

        if ($data):
            $this->entityManager->remove($data);
            $this->entityManager->flush();

            return $data;
        endif;
    }

    /** Update Data by Id */
    public function update(array $data, array $args) {
        $item = $this->repository->findBy($args)[0] ?? null;

        if ($item):
            foreach ($data as $key => $value)
                $item->__set($key, $value);

            $this->entityManager->merge($item);
            $this->entityManager->flush();

            return $data;
        endif;
    }

    /** Insert Data */
    public function insert(array $args) {
        $data = new $this->entity;

        foreach ($args as $key => $value)
            $data->__set($key, $value);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}