<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Controller;

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
        private CommandValidatorInterface $validator,
        private CommandBusInterface $bus
    )
    {
    }

    public function __invoke(Request $request)
    {
        $command = new PingCommand([
            'id'        => Uuid::create()->toString(),
            'firstName' => $request->get('firstName'),
        ]);

        $result = $this->validator->validate($command);

        if ($result->valid()) {
            $this->bus->dispatch($command);
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