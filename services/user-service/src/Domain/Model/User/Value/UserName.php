<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User\Value;

use Zinc\Core\Domain\Value\StringValue;

class UserName extends StringValue
{
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException('User name cannot be empty');
        }
        parent::__construct($value);
    }
} 