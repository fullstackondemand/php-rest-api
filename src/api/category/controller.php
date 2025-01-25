<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use RestJS\Abstract\Controller as AbstractController;
use RestJS\Api\Category\Model;

class Controller extends AbstractController {

    public function __construct(private Model $_model) {
        parent::__construct();
    }

    protected function setModel() {
        return $this->_model;
    }

    protected function setData() {
        return $this->_model->findAll();
    }
}