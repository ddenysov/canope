<?php

declare(strict_types=1);

namespace Zinc\Core\Command\Bridge\Symfony;

use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\TransportNamesStamp;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\Command\CommandInterface;
use Symfony\Component\DependencyInjection\Attribute\Service;
use Zinc\Core\Logging\Logger;

/**
 * CommandBus adapter backed by Symfony Messenger.
 */
#[Service(alias: CommandBusInterface::class)]
final readonly class MessengerCommandBus implements CommandBusInterface
{
    public function __construct(
        private MessageBusInterface $bus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function dispatch(CommandInterface $command): void
    {
        Logger::debug('Dispatching command command', [
            'class' => $command::class,
        ]);
        $this->bus->dispatch(
            $command,
            [new TransportNamesStamp(['rr'])]
        );
    }
}
