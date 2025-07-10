<?php

declare(strict_types=1);

namespace Zinc\Core\Domain\Event;

use Zinc\Core\Domain\Value\UuidInterface;
use Zinc\Core\Support\Array\AsArray;

interface EventInterface extends AsArray {
    public function getAggregateId(): mixed;

    public function getAggregateType(): string;

    public function getId(): EventId;

    public static function fromArray(array $data): static;
}
