<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Controller;

use Denysov\UserService\Application\Query\FindPingQuery;
use Denysov\UserService\Delivery\Http\Response\Resource\PingResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zinc\Core\Query\QueryBusInterface;

class ViewController
{
    public function __construct(
        private QueryBusInterface  $bus,
    )
    {
    }

    public function __invoke(string $id)
    {
        $result = $this->bus->dispatch(new FindPingQuery(['id' => $id]));

        return new JsonResponse(new PingResource($result));
    }
}