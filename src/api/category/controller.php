<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use RestJS\Controller\AbstractController;
use RestJS\Api\Category\Model;

class Controller extends AbstractController {

    public function __construct(private Model $model) { 
        parent::__construct($model, $model->findAll());
    }
}