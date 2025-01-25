<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Trait\Controller as CoreController;
use RestJS\Abstract\Authorization as AuthController;
use RestJS\Api\User\Model;

class Controller extends AuthController {

    function __construct(private Model $model) {
        $this->data = $this->model->findAll();
        parent::__construct();
    }

    protected function setModel() {
        return $this->model;
    }

    // Trait Controller
    use CoreController; 
}