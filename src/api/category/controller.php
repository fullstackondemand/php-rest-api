<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use Slim\Exception\HttpBadRequestException;
use RestJS\Api\Category\Model;
use RestJS\Class\Response;
use function RestJS\response;

class Controller {

    function __construct(private Model $model) { }

    /** Fetch all data */
    public function findAll($req, $res) {
        $result = $this->model->all();
        return response($req, $res, new Response(data: $result));
    }

    /** Fetch data by id */
    public function findById($req, $res, $args) {
        $result = $this->model->find( $args['id']);
        count($result) == 0 && throw new HttpBadRequestException($req, "Something went wrong...");
        return response($req, $res, args: new Response(data: $result));
    }

    /** Delete data by id */
    public function deleteById($req, $res, $args) {
        $result = $this->model->delete($args['id']);
        $result == 0 && throw new HttpBadRequestException($req, "Something went wrong...");
        return response($req, $res, new Response(message: "This item has been successfully removed.", data: $result));
    }

    /** Insert data */
    public function create($req, $res, $args) {
        $this->model->insert($req->getParsedBody());
        return response($req, $res, new Response(message: "This item has been successfully added."));
    }

    /** Update by id */
    public function updateById($req, $res, $args) {
        $result = $this->model->update($req->getParsedBody(), $args["id"]);
        $result == 0 && throw new HttpBadRequestException($req, "Somthing went wrong...");
        return response($req, $res, new Response(message: "This item has been successfully updated.", data: $result));
    }
}