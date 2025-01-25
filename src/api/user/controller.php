<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Abstract\Authorization as AuthController;
use RestJS\Api\User\Model;

class Controller extends AuthController {

    public function __construct(protected Model $_model) {
        parent::__construct();
    }

    protected function setModel() {
        return $this->_model;
    }

    protected function setData() {
        return $this->_model->findAll();
    }
}