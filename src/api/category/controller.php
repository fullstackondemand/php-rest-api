<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use RestJS\Api\Category\Model;
use RestJS\Class\Response;
use function RestJS\response;

class Controller {

    function __construct(private Model $model) { }

    /** Fetch All Data */
    function findAll($req, $res) {
        $result = $this->model->all();
        return response($req, $res, new Response(data: $result));
    }
}