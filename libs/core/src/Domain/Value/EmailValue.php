<?php
declare(strict_types=1);

namespace Zinc\Core\Domain\Value;

class EmailValue extends StringValue
{
    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }
        parent::__construct($value);
    }
} 