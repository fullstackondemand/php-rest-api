<?php
declare(strict_types=1);
namespace RestJS\Trait;

/** Getter and Setter Functions */
trait GetterAndSetter {

    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }
}