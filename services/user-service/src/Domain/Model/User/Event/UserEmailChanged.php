<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User\Event;

use Denysov\UserService\Domain\Model\User\Value\UserEmail;
use Denysov\UserService\Domain\Model\User\Value\UserId;
use Zinc\Core\Domain\Event\EventInterface;
use Zinc\Core\Domain\Value\UuidInterface;

class UserEmailChanged implements EventInterface
{
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UserId $aggregateId,
        private readonly UserEmail $newEmail
    ) {}

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getAggregateId(): UuidInterface
    {
        return $this->aggregateId;
    }

    public function getAggregateType(): string
    {
        return 'user';
    }

    public function getNewEmail(): UserEmail
    {
        return $this->newEmail;
    }

    public function toArray(): array
    {
        return [
            'id'           => $this->id->toString(),
            'aggregate_id' => $this->aggregateId->toString(),
            'new_email'    => $this->newEmail->toString(),
        ];
    }
} 