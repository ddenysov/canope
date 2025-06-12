<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Controller;

use Denysov\UserService\Application\Query\PingListQuery;
use Denysov\UserService\Delivery\Http\Response\PingCollection;
use Denysov\UserService\Delivery\Http\Response\PingCollectionResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zinc\Core\Http\Response\JsonApiCollectionResponse;
use Zinc\Core\Query\MapQueryString;
use Zinc\Core\Query\ListQuery;
use Zinc\Core\Query\QueryBusInterface;

class ListController
{

    public function __construct(private QueryBusInterface $bus)
    {
    }

    public function __invoke(#[MapQueryString] PingListQuery $query): JsonResponse
    {
        $result = $this->bus->dispatch($query);

        return new PingCollection($query, $result);
    }
}