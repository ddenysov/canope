<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http;

use Denysov\UserService\Application\Command\Ping\PingCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\Logging\Logger;

class IndexController
{
    public function __construct(
        private ValidatorInterface $validator
    ) {}

    public function __invoke(CommandBusInterface $bus, LoggerInterface $logger)
    {
        $command = new PingCommand();
        $violations = $this->validator->validate($command);
        $errors = [];

        foreach ($violations as $violation) {
            $field = $violation->getPropertyPath();
            $errors[$field][] = $violation->getMessage();
        }
        $bus->dispatch($command);

        return new JsonResponse([
            'framework' => 'User Service',
            'time'      => rand(10, 99),
            'violations' => $errors
        ]);
    }
}