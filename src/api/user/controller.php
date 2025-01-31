<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Controller\AbstractAuthController;
use RestJS\Api\User\Model;

class Controller extends AbstractAuthController {

    public function __construct(private Model $model) { 
        parent::__construct($model);
    }
}