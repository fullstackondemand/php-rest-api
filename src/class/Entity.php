<?php
declare(strict_types=1);
namespace RestJS\Class;

/** Entity Functions */
class Entity {

    /** Get Value by Column */
    public function __get($key) {
        return $this->$key;
    }

    /** Set Value by Column */
    public function __set($key, $value) {
        $this->$key = $value;
    }
}