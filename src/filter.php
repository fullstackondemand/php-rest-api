<?php
declare(strict_types=1);
namespace RestJS;

use Psr\Http\Message\ServerRequestInterface as Request;

/** Filter Function for Response Data Manipulation */
function filter($data, Request $req): array {

    /** Query Fetch Data */
    $data = array_reverse($data);

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

    /** Search Query Params */
    $search ??= null;

    /** Sort Query Params */
    $sort ??= null;

    /** Sort Order Query Params */
    $order ??= 'asc';                    // asc or desc

    // Search All Column Fetch All Data
    if ($search):
        foreach ($data as $item):
            $isSearch = false;

            foreach (array_values((array) $item) as $value):
                $searchWith = str_contains(strtolower(trim(strip_tags((string) $value))), strtolower(trim($search)));

                if ($searchWith)
                    $isSearch = true;
            endforeach;

            if ($isSearch)
                array_push($filterData, $item);

        endforeach;
    endif;

    // Sorted Column Fetch All Data
    if ($sort):
        $filterData = empty($filterData) ? $data : $filterData;

        usort($filterData, fn($a, $b) =>
            $order == 'asc' ? $a->$sort > $b->$sort : $a->$sort < $b->$sort);
    endif;

    // Selected Column Fetch All Data
    if ($filter):
        $filter = explode(",", $filter);

        if ($search || $sort)
            $data = $filterData;

        $filterData = [];

        foreach ($data as $item)
            array_push($filterData, array_intersect_key((array) $item, array_flip($filter)));
    endif;

    // According Pagination Fetch All Data
    if ($page):
        if ($filter || $search || $sort)
            $data = $filterData;

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