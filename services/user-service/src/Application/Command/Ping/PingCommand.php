<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Command\Ping;

use Zinc\Core\Command\AbstractCommand;
use Zinc\Core\Command\CommandInterface;

class PingCommand extends AbstractCommand implements CommandInterface
{
    public string $firstName = '';
}