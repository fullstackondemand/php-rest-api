<?php
declare(strict_types=1);
namespace RestJS\Api\Author;
use RestJS\Trait\Controller as CoreController;
use RestJS\Api\Author\Model;

class Controller {

    function __construct(private Model $model) {
        $this->result = $this->model->fetch();
    }

    /** Use core controller functions */
    use CoreController;
}