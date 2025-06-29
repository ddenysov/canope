<?php
declare(strict_types=1);

namespace Zinc\Core\Integration;

class MessagePayload
{
    public function __construct(private array $payload)
    {
    }

    public function toArray(): array
    {
        return $this->payload;
    }
}