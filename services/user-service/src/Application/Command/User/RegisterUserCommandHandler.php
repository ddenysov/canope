<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Command\User;

use Denysov\UserService\Domain\Model\User\User;
use Denysov\UserService\Domain\Model\User\Value\UserEmail;
use Denysov\UserService\Domain\Model\User\Value\UserId;
use Denysov\UserService\Domain\Model\User\Value\UserName;
use Denysov\UserService\Domain\Model\User\Value\UserPassword;
use Zinc\Core\Command\CommandHandlerInterface;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Security\Password\PasswordHasher;

class RegisterUserCommandHandler implements CommandHandlerInterface
{

    public function __construct(private PasswordHasher $passwordHasher)
    {
    }

    public function __invoke(RegisterUserCommand $command)
    {
        Logger::info('REGISTER USER HANDLER STARTED');

        $user = User::register(
            new UserId($command->id),
            new UserEmail($command->email),
            new UserName($command->name),
            new UserPassword($this->passwordHasher->makeHash($command->password))
        );

        $events = $user->releaseEvents();
        Logger::info('REGISTER USER HANDLER FINISHED', [
            'userId' => $user->getId()->toString(),
            'events' => (array) $events,
        ]);

        return $events;
    }
} 