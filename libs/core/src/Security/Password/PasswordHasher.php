<?php
declare(strict_types=1);

namespace Zinc\Core\Security\Password;

interface PasswordHasher
{
    public function makeHash(string $password);
}