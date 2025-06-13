<?php
declare(strict_types=1);

namespace Zinc\Core\Http\Resource;

use JsonSerializable;
use Zinc\Core\Query\ListQuery;
use Zinc\Core\Query\PaginatedResult;
use Zinc\Core\Support\Url\Url;

class ResourceCollection implements JsonSerializable
{
    public function __construct(private string $resource, private ListQuery $query, private PaginatedResult $result)
    {

    }

    #[\Override] public function jsonSerialize(): mixed
    {
        $totalPages  = (int) floor($this->result->total / $this->query->pageSize);

        $queryParams = [];
        if ($this->query->sort !== null) {
            $queryParams['sort'] = $this->query->sort;
        }
        foreach ($this->query->filter as $key => $value) {
            $queryParams["filter[$key]"] = $value;
        }


        $buildLink = function (int $page) use ($queryParams): string {
            $params = array_merge($queryParams, [
                'page[number]' => (string) $page,
                'page[size]'   => (string) $this->query->pageSize,
            ]);
            return Url::path($params);
        };

        $resource = $this->resource;

        $items = array_map(
            fn ($item) => (new $resource($item))(),
            $this->result->items,
        );

        return [
            'data'   => $items,
            'meta'   => [
                'page' => [
                    'number'     => $this->query->pageNumber,
                    'size'       => $this->query->pageSize,
                    'total'      => $this->result->total,
                    'totalPages' => $totalPages,
                ],
            ],
            'links'  => [
                'self'  => $buildLink($this->query->pageNumber),
                'first' => $buildLink(1),
                'prev'  => $this->query->pageNumber > 1 ? $buildLink($this->query->pageNumber - 1) : null,
                'next'  => $this->query->pageNumber < $totalPages ? $buildLink($this->query->pageNumber + 1) : null,
                'last'  => $buildLink($totalPages),
            ],
        ];
    }
}