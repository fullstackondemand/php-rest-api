<?php
declare(strict_types=1);
namespace RestJS\Api\Author;
use \RestJS\Trait\Model as CoreModel;
use RestJS\Api\Author\Author;

class Model {

    /** Variables Declaration */
    private $table = Author::class;

    /** Use core model functions */
    use CoreModel;
}