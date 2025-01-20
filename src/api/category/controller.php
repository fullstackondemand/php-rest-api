<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use RestJS\Trait\Controller as CoreController;
use RestJS\Api\Category\Model;

class Controller {

    function __construct(private Model $model) {
        $this->result = $this->model->fetch();
    }

    /** Use core controller functions */
    use CoreController;
}