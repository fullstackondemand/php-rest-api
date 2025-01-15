<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use \RestJS\Trait\Model as CoreModel;
use RestJS\Api\Category\Category;

class Model {

    /** Variables Declaration */
    private $table = Category::class;

    /** Use core model functions */
    use CoreModel;
}