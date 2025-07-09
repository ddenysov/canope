<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User\Event;

use Zinc\Core\Domain\Value\StringValue;
use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Event\EventId;
use Zinc\Core\Event\EventInterface;

class UserEmailChanged implements EventInterface
{
    private EventId $id;
    private Uuid $aggregateId;
    private StringValue $newEmail;

    public function __construct(EventId $id, Uuid $aggregateId, StringValue $newEmail)
    {
        $this->id = $id;
        $this->aggregateId = $aggregateId;
        $this->newEmail = $newEmail;
    }

    public function getId(): EventId { return $this->id; }
    public function getAggregateId(): Uuid { return $this->aggregateId; }
    public function getNewEmail(): StringValue { return $this->newEmail; }
} 