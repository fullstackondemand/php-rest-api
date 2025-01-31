<?php
declare(strict_types=1);
namespace RestJS\Controller;

use RestJS\Message\Response;
use function RestJS\response, RestJS\checkNull;

/** Abstract Controller Functions */
class AbstractController {

    /** Model Class Object */
    protected $_model;

    public function __construct($model) {
        $this->_model = $model;
    }

    /** Find All Data */
    public function findAll($req, $res) {
        return response($req, $res, new Response(data: $this->_model->findAll()));
    }

    /** Find Data by Column */
    public function findByColumn($req, $res, $args) {
        $data = $this->_model->findBy($args);
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