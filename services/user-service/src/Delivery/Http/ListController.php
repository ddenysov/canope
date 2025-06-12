<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http;

use Symfony\Component\HttpFoundation\JsonResponse;
use Zinc\Core\Query\MapQueryString;
use Zinc\Core\Query\ListQuery;

class ListController
{
    public function __invoke(#[MapQueryString] ListQuery $query): JsonResponse
    {
        $page = $query->page;
        //$sort = $query->sort;
        // ....

        return new JsonResponse([
            'page' => $query->pageNumber,
            'size' => $query->pageSize,
        ]);
    }
}