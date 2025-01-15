<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use RestJS\Trait\Controller as CoreController;
use RestJS\Api\Category\Model;

class Controller {

    function __construct(private Model $model) {}

    /** Use core controller functions */
    use CoreController;
}