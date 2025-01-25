<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Abstract\Model as AbstractModel;
use RestJS\Api\User\User;

class Model extends AbstractModel {

    protected function setTable() {
        return User::class;
    }
}