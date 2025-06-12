<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Query;

use Zinc\Core\DataStore\Criteria;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Query\PaginatedResult;
use Zinc\Core\Query\QueryHandlerInterface;

class PingListQueryHandler implements QueryHandlerInterface
{

    public function __construct(private DataStoreInterface $store)
    {
    }

    public function __invoke(PingListQuery $query): PaginatedResult
    {
        $items = $this->store->find(
            'read_model_users',
        );

        return new PaginatedResult($items, 123);
    }
}