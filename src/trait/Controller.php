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

        /** Variables Declaration */
        $result = $this->result;
        $filter = $req->getQueryParams()['filter'] ?? null;
        
        /** Selected column fetch all data */
        if ($filter):
            $result = [];
            $filter = explode(",", $filter);
            
            foreach ($this->result as $item)
            array_push($result, array_intersect_key($item, array_flip($filter)));
        endif;

        return response($req, $res, new Response(data: $result));
    }

    /** Fetch data by Column */
    public function findByColumn($req, $res, $args) {
        
        foreach ($args as $key => $value)
        $result = array_filter($this->result, fn($item) => $item[$key] == $args[$key]);

        checkNull($result, $req);
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
        $result = $this->model->insert($req->getParsedBody());
        return response($req, $res, new Response(message: "This item has been successfully added.", data: $result));
    }

    /** Update by id */
    public function updateById($req, $res, $args) {
        $result = $this->model->update($req->getParsedBody(), $args["id"]);
        checkNull($result, $req);
        return response($req, $res, new Response(message: "This item has been successfully updated.", data: $result));
    }
}