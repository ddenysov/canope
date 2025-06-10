<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Query;

use Zinc\Core\DataStore\Criteria;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Query\QueryHandlerInterface;

class FindPingQueryHandler implements QueryHandlerInterface
{

    public function __construct(private DataStoreInterface $store,)
    {
    }

    public function __invoke(FindPingQuery $query): array
    {
        return $this->store->findOne(
            'read_model_users',
            new Criteria('id', '=', $query->id)
        );
    }
}