<?php
declare(strict_types=1);
namespace RestJS\Trait;
use RestJS\Class\Response;
use function RestJS\response, RestJS\checkNull;

/** Core Controller Functions */
trait Controller {

      /** Variables Declaration */
    private $result;

     /** Fetch all data */
     public function findAll($req, $res) {
        return response($req, $res, new Response(data: $this->result));
    }

    /** Fetch data by id */
    public function findById($req, $res, $args) {
        $result = array_filter($this->result, fn($item) => $item['id'] == $args['id']);
        checkNull($result, $req);
        return response($req, $res, args: new Response(data: [...$result]));
    }

    /** Fetch data By slug */
    public function findBySlug($req, $res, $args)  {
        $result = array_filter($this->result, fn($item) => $item['slug'] == $args['slug']);
        checkNull(count($result), $req);
        return response($req, $res, args: new Response(data: [...$result]));
    }

    /** Delete data by id */
    public function deleteById($req, $res, $args)  {
        $result = $this->model->delete($args['id']);
        checkNull($result, $req);
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
        checkNull($result, $req);
        return response($req, $res, new Response(message: "This item has been successfully updated.", data: $result));
    }
}