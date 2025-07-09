<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User\Value;

use Zinc\Core\Domain\Value\StringValue;

class UserPassword extends StringValue
{
    public function __construct(string $value)
    {
        if (strlen($value) < 8) {
            throw new \InvalidArgumentException('Password must be at least 8 characters');
        }
        parent::__construct($value);
    }
} 