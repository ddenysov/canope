<?php
declare(strict_types=1);

namespace Zinc\Core\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Zinc\Core\Query\ListQuery;
use Zinc\Core\Query\PaginatedResult;

class JsonApiCollectionResponse extends JsonResponse
{
    public function __construct(ListQuery $query, PaginatedResult $result)
    {
        $totalPages  = 100;
        $baseUrl     = 'http://localhost:8280/list';
        $queryParams = [];
        if ($query->sort !== null) {
            $queryParams['sort'] = $query->sort;
        }
        foreach ($query->filter as $key => $value) {
            $queryParams["filter[$key]"] = $value;
        }


        $buildLink = function (int $page) use ($baseUrl, $query, $queryParams): string {
            $params = array_merge($queryParams, [
                'page[number]' => (string) $page,
                'page[size]'   => (string) $query->pageSize,
            ]);
            return $baseUrl . '?' . http_build_query($params);
        };

        $items = array_map(
            fn($item) => [
                'type' => 'user',
                'id' => (string) $item['id'],
                'attributes' => [
                    'email' => $item['email'],
                ],
            ],
            $result->items,
        );

        parent::__construct([
            'data' => $items,
            'meta'  => [
                'page' => [
                    'number'     => $query->pageNumber,
                    'size'       => $query->pageSize,
                    'total'      => 123,
                    'totalPages' => $totalPages,
                ],
            ],
            'links' => [
                'self'  => $buildLink($query->pageNumber),
                'first' => $buildLink(1),
                'prev'  => $query->pageNumber > 1 ? $buildLink($query->pageNumber - 1) : null,
                'next'  => $query->pageNumber < $totalPages ? $buildLink($query->pageNumber + 1) : null,
                'last'  => $buildLink($totalPages),
            ],
        ]);
    }
}