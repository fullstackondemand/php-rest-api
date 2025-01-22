<?php
declare(strict_types=1);
namespace RestJS\Api\User;
use RestJS\Trait\Controller as CoreController;
use RestJS\Trait\Authorization as AuthController;
use RestJS\Api\User\Model;

class Controller {

    function __construct(private Model $model) {
        $this->result = $this->model->fetchAll();
    }

    /** Use core controller functions */
    use CoreController;
    
    /** Use authorization controller functions */
    use AuthController; 
}