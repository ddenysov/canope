<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Command\User;

use Zinc\Core\Command\AbstractCommand;
use Zinc\Core\Command\CommandInterface;

class RegisterUserCommand extends AbstractCommand implements CommandInterface
{
    public string $id = '';
    public string $email = '';
    public string $name = '';
    public string $password = '';
} 