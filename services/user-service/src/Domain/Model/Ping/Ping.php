<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\Ping;

use Denysov\UserService\Domain\Model\Ping\Event\PingCreated;
use Tests\Stub\StubDomainEvent;
use Zinc\Core\Domain\Aggregate\AbstractAggregateRoot;
use Zinc\Core\Domain\Aggregate\AggregateRootInterface;
use Zinc\Core\Domain\Value\StringValue;
use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Event\EventId;

class Ping extends AbstractAggregateRoot implements AggregateRootInterface
{
    private StringValue $email;

    public static function create(
        PingId      $id,
        StringValue $email,
    ): self
    {
        $instance = new self();
        $instance->recordThat(new PingCreated(
            id: EventId::create(),
            aggregateId: $id,
            email: $email
        ));

        return $instance;
    }

    public function onPingCreated(PingCreated $event)
    {
        $this->id    = $event->getAggregateId();
        $this->email = $event->getEmail();
    }
}