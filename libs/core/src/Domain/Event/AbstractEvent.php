<?php

declare(strict_types=1);

namespace Zinc\Core\Domain\Event;

use Zinc\Core\Domain\Value\UuidInterface;
use Zinc\Core\Event\EventId;

abstract class AbstractEvent implements EventInterface
{
    /**
     * Uniq event identifier
     * - help with deduplication
     * - tracing
     * - uniq in event store
     */
    public UuidInterface $id;

    /**
     * Aggregate produced this event
     */
    public UuidInterface $aggregateId;

    public function __construct(EventId $id, UuidInterface $aggregateId)
    {
        $this->id          = $id;
        $this->aggregateId = $aggregateId;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @throws \Exception
     */
    public function toArray(): array
    {

    }

    public function getAggregateId(): UuidInterface
    {
        return $this->aggregateId;
    }
}
