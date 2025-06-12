<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Controller;

use Denysov\UserService\Application\Query\FindPingQuery;
use Denysov\UserService\Delivery\Http\Response\Resource\PingResource;
use Hateoas\HateoasBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Query\Bridge\Symfony\RequestToQueryTransformer;
use Zinc\Core\Query\QueryBusInterface;

class ViewController
{
    public function __construct(
        private DataStoreInterface $store,
        private QueryBusInterface  $bus,
    )
    {
    }

    public function __invoke(string $id)
    {
        $query  = new FindPingQuery();
        $query->id = $id;
        $result = $this->bus->dispatch($query);

        return new JsonResponse((new PingResource($result))());
    }
}