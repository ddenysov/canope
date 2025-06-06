<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http;

use Denysov\UserService\Application\Command\Ping\PingCommand;
use Psr\Log\LoggerInterface;
use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Validator\CommandValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Zinc\Core\Command\CommandBusInterface;

class IndexController
{
    public function __construct(
        private CommandValidatorInterface $validator
    )
    {
    }

    public function __invoke(Request $request, CommandBusInterface $bus, LoggerInterface $logger)
    {
        $command = new PingCommand([
            'id'        => Uuid::create()->toString(),
            'firstName' => $request->get('firstName'),
        ]);

        $result = $this->validator->validate($command);

        if ($result->valid()) {
            $bus->dispatch($command);
        }

        return new JsonResponse([
            'framework'  => 'User Service',
            'time'       => rand(10, 99),
            'violations' => $result->errors,
            'data'       => $request->get('firstName'),
            'firstName'  => $command->firstName,
        ]);
    }
}