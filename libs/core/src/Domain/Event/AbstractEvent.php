<?php

declare(strict_types=1);

namespace Zinc\Core\Domain\Event;

use Zinc\Core\Domain\Value\UuidInterface;

abstract class AbstractEvent implements EventInterface
{
    /**
     * Uniq event identifier
     * - help with deduplication
     * - tracing
     * - uniq in event store
     */
    protected EventId $id;

    /**
     * Aggregate produced this event
     */
    protected UuidInterface $aggregateId;

    public function __construct(EventId $id, UuidInterface $aggregateId)
    {
        $this->id          = $id;
        $this->aggregateId = $aggregateId;
    }

    public function getId(): EventId
    {
        return $this->id;
    }

    /**
     * @throws \Exception
     */
    public function toArray(): array
    {
        return [];
    }

    public function getAggregateId(): mixed
    {
        return $this->aggregateId;
    }
}
