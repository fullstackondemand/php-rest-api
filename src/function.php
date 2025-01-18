<?php
declare(strict_types=1);
namespace RestJS;
use Slim\Exception\HttpBadRequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/** Query Response Function */
function response(Request $req, Response $res, mixed $args) {
    $res->getBody()->write(json_encode($args));
    return $res;
}

/** Check Null Function */
function checkNull($result, $req) {
    !boolval($result) && throw new HttpBadRequestException($req, "Something went wrong...");
}

/** Many To One Relationship Function */
function ManyToOne($many, $one, $property) {
    $result = [];

    foreach ($many as $manyItem):
        $manyItem[$property] = array_filter($one, fn($item) => $manyItem[$property] == $item['id'])[0];
        array_push($result, $manyItem);
    endforeach;

    return $result;
}

/** One To Many Relationship Function */
function OneToMany($one, $many, $property) {
    $result = [];

    foreach ($one as $oneItem):

        if($oneItem[$property] == null) $oneItem[$property] =[];
        else {
            $ids = json_decode($oneItem[$property]);
            $oneItem[$property] = [];

            foreach ($ids as $id):
                $array = array_filter($many, fn($item) => $id == $item['id']);
                array_push($oneItem[$property], ...$array);
            endforeach;
        }
        
        array_push($result, $oneItem);
    endforeach;

    return $result;
}