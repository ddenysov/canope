<?php
declare(strict_types=1);

namespace Denysov\UserService\Domain\Model\User;

use Denysov\UserService\Domain\Model\User\Event\UserCreated;
use Denysov\UserService\Domain\Model\User\Event\UserEmailChanged;
use Denysov\UserService\Domain\Model\User\Value\UserEmail;
use Denysov\UserService\Domain\Model\User\Value\UserId;
use Denysov\UserService\Domain\Model\User\Value\UserName;
use Denysov\UserService\Domain\Model\User\Value\UserPassword;
use Zinc\Core\Domain\Aggregate\AbstractAggregateRoot;
use Zinc\Core\Domain\Aggregate\AggregateRootInterface;
use Zinc\Core\Event\EventId;

class User extends AbstractAggregateRoot implements AggregateRootInterface
{
    private UserEmail $email;
    private UserName $name;
    private UserPassword $password;
    private bool $active;

    public static function register(
        UserId $id,
        UserEmail $email,
        UserName $name,
        UserPassword $password
    ): self
    {
        $instance = new self();
        $instance->recordThat(new UserCreated(
            id: EventId::create(),
            aggregateId: $id,
            email: $email,
            name: $name,
            password: $password
        ));

        return $instance;
    }

    public function changeEmail(UserEmail $newEmail): void
    {
        if (!$this->email->equals($newEmail)) {
            $this->recordThat(new UserEmailChanged(
                id: EventId::create(),
                aggregateId: $this->id,
                newEmail: $newEmail
            ));
        }
    }

    public function onUserCreated(UserCreated $event): void
    {
        $this->id       = $event->getAggregateId();
        $this->email    = $event->getEmail();
        $this->name     = $event->getName();
        $this->password = $event->getPassword();
        $this->active   = true;
    }

    public function onUserEmailChanged(UserEmailChanged $event): void
    {
        $this->email = $event->getNewEmail();
    }

    // Геттеры для read-модели или тестов (по необходимости)
    public function getId(): UserId
    {
        return $this->id;
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

    public function isActive(): bool
    {
        return $this->active;
    }
} 