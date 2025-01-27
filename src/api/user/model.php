<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use RestJS\Model\AbstractModel;
use RestJS\Api\User\User;

class Model extends AbstractModel {

    protected function setEntity() {
        return User::class;
    }
}