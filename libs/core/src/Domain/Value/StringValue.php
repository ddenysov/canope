<?php
declare(strict_types=1);

namespace Zinc\Core\Domain\Value;

class StringValue extends AbstractValue
{

    public function __construct(private string $value)
    {
    }

    public function toString(): string
    {
        return $this->value;
    }
}