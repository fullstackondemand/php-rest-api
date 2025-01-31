<?php
declare(strict_types=1);
namespace RestJS\Relationship;

/** Many To One Relationship Function */
function manyToOne($many, $one, $property) {
    $result = [];

    foreach ($many as $manyItem):

        // Object Convert to Array
        $manyItem = (array) $manyItem;

        $filter = array_filter($one, fn($item) => $manyItem[$property] == $item->id);
        $manyItem[$property] = [...$filter][0];
        array_push($result, $manyItem);
    endforeach;

    return $result;
}

/** One To Many Relationship Function */
function oneToMany($one, $many, $property) {
    $result = [];

    foreach ($one as $oneItem):

        // Object Convert to Array
        $oneItem = (array) $oneItem;

        if ($oneItem[$property] == null) $oneItem[$property] = [];
        else {
            $ids = json_decode($oneItem[$property]);
            $oneItem[$property] = [];

            foreach ($ids as $id):
                $array = array_filter($many, fn($item) => $id == $item->id);
                array_push($oneItem[$property], ...$array);
            endforeach;
        }

        array_push($result, $oneItem);
    endforeach;

    return $result;
}