<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use RestJS\Abstract\Controller as AbstractController;
use RestJS\Api\Category\Model;

class Controller extends AbstractController {

    function __construct(private Model $model) {
        parent::__construct();
    }

    protected function setModel() {
        return $this->model;
    }

    protected function setData() {
        return $this->model->findAll();
    }
}