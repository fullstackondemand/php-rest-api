<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Trait\Controller as CoreController;
use RestJS\Trait\Authorization as AuthController;
use RestJS\Api\User\Model;

class Controller {

    function __construct(private Model $model) {
        $this->data = $this->model->findAll();
    }

    // Trait Controller
    use CoreController;
    
    // Trait Authorization
    use AuthController; 
}