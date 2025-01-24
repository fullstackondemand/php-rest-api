<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Trait\Model as CoreModel;
use RestJS\Api\User\User;

class Model {

    /** Entity or Table Variable */
    private $table = User::class;

    // Trait Model
    use CoreModel;
}