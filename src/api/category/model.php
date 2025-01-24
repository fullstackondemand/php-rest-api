<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use RestJS\Trait\Model as CoreModel;
use RestJS\Api\Category\Category;

class Model {

    /** Entity or Table Variable */
    private $table = Category::class;

    // Trait Model
    use CoreModel;
}