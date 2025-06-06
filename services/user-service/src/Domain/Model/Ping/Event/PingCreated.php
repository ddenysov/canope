<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\Ping\Event;

use Denysov\UserService\Domain\Model\Ping\PingId;
use Zinc\Core\Domain\Event\AbstractEvent;
use Zinc\Core\Domain\Event\EventInterface;
use Zinc\Core\Domain\Value\UuidInterface;

class PingCreated extends AbstractEvent implements EventInterface
{
    #[\Override] public function getId(): PingId
    {
        return parent::getId();
    }
}