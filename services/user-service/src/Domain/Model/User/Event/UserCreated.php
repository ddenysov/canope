<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User\Event;

use Denysov\UserService\Domain\Model\User\User;
use Denysov\UserService\Domain\Model\User\Value\UserEmail;
use Denysov\UserService\Domain\Model\User\Value\UserId;
use Denysov\UserService\Domain\Model\User\Value\UserName;
use Denysov\UserService\Domain\Model\User\Value\UserPassword;
use Zinc\Core\Domain\Event\AbstractEvent;
use Zinc\Core\Domain\Event\EventInterface;
use Zinc\Core\Domain\Value\UuidInterface;
use Zinc\Core\Event\EventId;

class UserCreated extends AbstractEvent implements EventInterface
{
    public function __construct(
        EventId                       $id,
        UserId                        $aggregateId,
        private readonly UserEmail    $email,
        private readonly UserName     $name,
        private readonly UserPassword $password
    ) {
        $this->aggregateId = $aggregateId;
        parent::__construct($id, $aggregateId);
    }

    public function getId(): EventId
    {
        return $this->id;
    }

    public function getAggregateId(): UuidInterface|UserId
    {
        return $this->aggregateId;
    }

    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    public function getName(): UserName
    {
        return $this->name;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    #[\Override] public function getAggregateType(): string
    {
        return User::class;
    }
} 