<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http;

use Denysov\UserService\Application\Query\FindPingQuery;
use Hateoas\HateoasBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\DataStore\Criteria;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Query\Bridge\Symfony\RequestToQueryTransformer;
use Zinc\Core\Query\QueryBusInterface;

class ViewController
{
    public function __construct(
        private DataStoreInterface $store,
        private QueryBusInterface $bus,
    )
    {
    }

    public function __invoke(Request $request, CommandBusInterface $bus, LoggerInterface $logger)
    {
        $query  = RequestToQueryTransformer::transform($request, FindPingQuery::class);
        $result = $this->bus->dispatch($query);

        $hateoas = HateoasBuilder::create()->build();
        $json    = $hateoas->serialize($result, 'json');

        return new JsonResponse([
            'data' => $result,
            'json' => json_decode($json, true),
        ]);
    }
}