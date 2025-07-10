<?php

declare(strict_types=1);

namespace Zinc\Core\Domain\Event;

use InvalidArgumentException;
use ReflectionClass;
use ReflectionNamedType;
use Zinc\Core\Domain\Value\Uuid;
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
    protected Uuid $aggregateId;

    public function __construct(EventId $id, Uuid $aggregateId)
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

    /**
     * @throws \ReflectionException
     */
    public static function fromArray(array $data): static
    {
        $refClass = new ReflectionClass(static::class);
        $ctor     = $refClass->getConstructor();

        // если нет конструктора — просто new User()
        if (! $ctor) {
            return new static();
        }

        $args = [];
        foreach ($ctor->getParameters() as $param) {
            $name = $param->getName();

            if (! array_key_exists($name, $data)) {
                if ($param->isDefaultValueAvailable()) {
                    $args[] = $param->getDefaultValue();
                    continue;
                }
                throw new InvalidArgumentException("Missing value for \${$name}");
            }

            $raw  = $data[$name];
            $type = $param->getType();

            // если это именованный класс, оборачиваем
            if ($type instanceof ReflectionNamedType && ! $type->isBuiltin()) {
                $typeName = $type->getName();
                $args[]   = new $typeName($raw);
            } else {
                $args[] = $raw;
            }
        }

        return $refClass->newInstanceArgs($args);
    }
}
