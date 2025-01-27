<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use RestJS\Model\AbstractModel;
use RestJS\Api\Category\Category;

class Model extends AbstractModel {

    protected function setEntity() {
        return Category::class;
    }
}