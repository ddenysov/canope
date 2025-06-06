<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http;

use Denysov\UserService\Application\Command\Ping\PingCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\Logging\Logger;

class IndexController
{
    public function __invoke(CommandBusInterface $bus, LoggerInterface $logger)
    {
        $bus->dispatch(new PingCommand());

        return new JsonResponse([
            'framework' => 'User Service',
            'time'      => rand(10, 99),
        ]);
    }
}