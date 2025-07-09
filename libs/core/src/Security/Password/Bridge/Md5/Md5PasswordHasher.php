<?php
declare(strict_types=1);

namespace Zinc\Core\Security\Password\Bridge\Md5;

use Zinc\Core\Security\Password\PasswordHasher;

class Md5PasswordHasher implements PasswordHasher
{
    public function makeHash(string $password)
    {
        return md5($password);
    }
} 