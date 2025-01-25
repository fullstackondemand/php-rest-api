<?php
declare(strict_types=1);
namespace RestJS\Abstract;

use RestJS\Class\Response;
use function RestJS\response, RestJS\checkNull;

/** Abstract Controller Functions */
abstract class Controller {

    /** Entity All Data */
    private $data;

    /** Model Class Object */
    private $model;

    /** Abstract Function for Set Model Class Object */
    abstract protected function setModel();

    /** Abstract Function for Set Entity All Data */
    abstract protected function setData();

    public function __construct() {
        $this->model = $this->setModel();
        $this->data = $this->setdata();
    }

    /** Find All Data */
    public function findAll($req, $res) {

        /** Filter Column Query Params */
        $filter = $req->getQueryParams()['filter'] ?? null;

        /** Filter Data */
        $data = $this->data;

        // Selected Column Fetch All Data
        if ($filter):
            $data = [];
            $filter = explode(",", $filter);

            foreach ($this->data as $item)
                array_push($data, array_intersect_key((array) $item, array_flip($filter)));
        endif;

        return response($req, $res, new Response(data: $data));
    }

    /** Find Data by Column */
    public function findByColumn($req, $res, $args) {

        foreach ($args as $key => $value)
            $data = array_filter($this->data, fn($item) => $item->$key == $args[$key]);

        checkNull($data, $req);
        return response($req, $res, args: new Response(data: [...$data]));
    }

    /** Delete Data by Id */
    public function delete($req, $res, $args) {
        $data = $this->model->delete($args['id']);
        checkNull($data, $req);
        return response($req, $res, new Response(message: "This item has been successfully removed.", data: $data));
    }

    /** Insert Data */
    public function insert($req, $res, $args) {
        $data = $this->model->insert($req->getParsedBody());
        return response($req, $res, new Response(message: "This item has been successfully added.", data: $data));
    }

    /** Update by Id */
    public function update($req, $res, $args) {
        $data = $this->model->update($req->getParsedBody(), $args["id"]);
        checkNull($data, $req);
        return response($req, $res, new Response(message: "This item has been successfully updated.", data: $data));
    }
}