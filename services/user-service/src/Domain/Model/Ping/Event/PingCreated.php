<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\Ping\Event;

use Denysov\UserService\Domain\Model\Ping\Ping;
use Zinc\Core\Domain\Event\AbstractEvent;
use Zinc\Core\Domain\Event\EventInterface;
use Zinc\Core\Domain\Value\StringValue;
use Zinc\Core\Domain\Value\UuidInterface;
use Zinc\Core\Event\EventId;

class PingCreated extends AbstractEvent implements EventInterface
{
    private StringValue $email;

    public function __construct(EventId $id, UuidInterface $aggregateId, StringValue $email)
    {
        parent::__construct($id, $aggregateId);
        $this->email = $email;
    }

    public function getEmail(): StringValue
    {
        return $this->email;
    }

    #[\Override] public function getAggregateType(): string
    {
        return Ping::class;
    }

    #[\Override] public function toArray(): array
    {
        return [
            'email' => $this->getEmail()->toString(),
        ];
    }
}