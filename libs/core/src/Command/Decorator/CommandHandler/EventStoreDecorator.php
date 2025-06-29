<?php

declare(strict_types=1);

namespace Zinc\Core\Command\Decorator\CommandHandler;

use Denysov\UserService\Domain\Model\Ping\Event\PingCreated;
use Zinc\Core\Command\CommandHandlerInterface;
use Zinc\Core\Command\CommandInterface;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Domain\Event\EventInterface;
use Zinc\Core\Domain\Event\EventStream;
use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Logging\Logger;

class EventStoreDecorator implements CommandHandlerInterface
{
    private static $x = 0;

    public function __construct(private CommandHandlerInterface $inner, private DataStoreInterface $store)
    {
    }

    public function __invoke(CommandInterface $command)
    {
        /**
         * @var EventStream $result
         */
        $result = $this->inner->__invoke($command);

        $this->store->transactional(function () use ($result) {
            foreach ($result as $event) {
                /**
                 * @var EventInterface $event
                 */
                $this->store->insert('event_store', [
                    'id'             => $event->getId()->toString(),
                    'aggregate_id'   => $event->getAggregateId()->toString(),
                    'aggregate_type' => $event->getAggregateType(),
                    'playhead'       => '1',
                    'event_type'     => $event::class,
                    'payload'        => json_encode($event->toArray()),
                    'metadata'       => '[]',
                ]);

                $this->store->insert('outbox', [
                    'id'             => $event->getId()->toString(),
                    'aggregate_id'   => $event->getAggregateId()->toString(),
                    'aggregate_type' => $event->getAggregateType(),
                    'message_type'   => $event::class,
                    'payload'        => json_encode($event->toArray()),
                    'metadata'       => '[]',
                    'created_at'     => date('Y-m-d H:i:s'),
                    'attempts'       => '0',
                ]);
            }


            Logger::info('Saving events to Event Store');
            self::$x++;
            if (self::$x < 2) {
                Logger::error('Events failed to save: Conflict');
                throw new \Exception('Failed');
            }
            Logger::info('Events saved');
        });

        return $result;
    }
}
