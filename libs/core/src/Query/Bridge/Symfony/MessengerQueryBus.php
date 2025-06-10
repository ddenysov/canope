<?php

declare(strict_types=1);

namespace Zinc\Core\Query\Bridge\Symfony;

use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Stamp\TransportNamesStamp;
use Zinc\Core\Command\CommandInterface;
use Zinc\Core\Query\QueryBusInterface;
use Zinc\Core\Query\QueryInterface;

/**
 * CommandBus adapter backed by Symfony Messenger.
 */
#[Service(alias: QueryBusInterface::class)]
final readonly class MessengerQueryBus implements QueryBusInterface
{
    public function __construct(
        private MessageBusInterface $bus,
    ) {}

    /**
     * @throws ExceptionInterface
     */
    public function dispatch(QueryInterface $query): array
    {
        $envelope = $this->bus->dispatch($query);

        $handledStamp = $envelope->last(HandledStamp::class);

        if (!$handledStamp instanceof HandledStamp) {
            throw new \RuntimeException('Query was not handled');
        }

        $result = $handledStamp->getResult();

        if (!is_array($result)) {
            throw new \InvalidArgumentException(
                sprintf('Handler must return array, got %s', gettype($result))
            );
        }

        return $result;
    }
}
