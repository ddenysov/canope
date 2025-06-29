<?php
declare(strict_types=1);

namespace Zinc\Core\Integration;

class MessageChannel
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}