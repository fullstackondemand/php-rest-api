<?php
declare(strict_types=1);
namespace RestJS\Controller;

use RestJS\Message\Response;
use function RestJS\response, RestJS\checkNull;

/** Abstract Controller Functions */
class AbstractController {

    /** Entity All Data */
    private $_data;

    /** Model Class Object */
    protected $_model;

    public function __construct($model, $data) {
        $this->_data = $data;
        $this->_model = $model;
    }

    /** Find All Data */
    public function findAll($req, $res) {

        /** Filter Column Query Params */
        $filter = $req->getQueryParams()['filter'] ?? null;

        /** Filter Data */
        $data = $this->_data;

        // Selected Column Fetch All Data
        if ($filter):
            $data = [];
            $filter = explode(",", $filter);

            foreach ($this->_data as $item)
                array_push($data, array_intersect_key((array) $item, array_flip($filter)));
        endif;

        return response($req, $res, new Response(data: $data));
    }

    /** Find Data by Column */
    public function findByColumn($req, $res, $args) {

        foreach ($args as $key => $value)
            $data = array_filter($this->_data, fn($item) => $item->$key == $args[$key]);

        checkNull($data, $req);
        return response($req, $res, args: new Response(data: [...$data]));
    }

    /** Delete Data by Id */
    public function delete($req, $res, $args) {
        $data = $this->_model->delete($args['id']);
        checkNull($data, $req);
        return response($req, $res, new Response(message: "This item has been successfully removed.", data: $data));
    }

    /** Insert Data */
    public function insert($req, $res, $args) {
        $data = $this->_model->insert($req->getParsedBody());
        return response($req, $res, new Response(message: "This item has been successfully added.", data: $data));
    }

    /** Update by Id */
    public function update($req, $res, $args) {
        $data = $this->_model->update($req->getParsedBody(), $args["id"]);
        checkNull($data, $req);
        return response($req, $res, new Response(message: "This item has been successfully updated.", data: $data));
    }
}