<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Abstract\Authorization as AuthController;
use RestJS\Api\User\Model;

class Controller extends AuthController {

    public function __construct(protected Model $model) {
        parent::__construct();
    }

    protected function setModel() {
        return $this->model;
    }

    protected function setData() {
        return $this->model->findAll();
    }
}