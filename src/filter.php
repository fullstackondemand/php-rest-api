<?php
declare(strict_types=1);
namespace RestJS;

use Psr\Http\Message\ServerRequestInterface as Request;

/** Filter Function for Response Data Manipulation */
function filter($data, Request $req): array {

    // Get Query Params Values
    extract($req->getQueryParams() ?? []);

    /** After Filter Data */
    $filterData = [];

    /** Filter Column Query Params */
    $filter ??= null;

    /** Pagination Page Number Query Params */
    $page ??= 1;

    /** Per Page Limit Query Params */
    $limit ??= 10;

    // Selected Column Fetch All Data
    if ($filter):
        $filter = explode(",", $filter);

        foreach ($data as $item)
            array_push($filterData, array_intersect_key((array) $item, array_flip($filter)));
    endif;

    // According Pagination Fetch All Data
    if ($page):
        $filter && $data = $filterData;
        $filterData = array_slice($data, $page == 1 ? 0 : $limit * ($page - 1), (int) $limit);
    endif;

    return [
        "page" => $page,
        "limit" => $limit,
        "totalPages" => ceil(count($data) / $limit),
        "totalItems" => count($data),
        "currentPageItems" => count($filterData),
        'data' => $filterData,
    ];
}