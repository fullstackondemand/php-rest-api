<?php
declare(strict_types=1);
namespace RestJS\Api\User;
use \RestJS\Trait\Model as CoreModel;
use RestJS\Api\User\User;

class Model {

    /** Variables Declaration */
    private $table = User::class;

    /** Use core model functions */
    use CoreModel;
}