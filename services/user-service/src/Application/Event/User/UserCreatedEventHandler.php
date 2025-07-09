<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Event\User;

use Denysov\UserService\Domain\Model\User\Event\UserCreated;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Event\EventHandlerInterface;
use Zinc\Core\Logging\Logger;

class UserCreatedEventHandler implements EventHandlerInterface
{
    public function __construct(private DataStoreInterface $store)
    {
    }

    public function __invoke(UserCreated $event)
    {
        $this->store->insert('read_model_users', [
            'id'       => $event->getAggregateId()->toString(),
            'email'    => $event->getEmail()->toString(),
            'name'     => $event->getName()->toString(),
            'password' => $event->getPassword()->toString(),
        ]);

        Logger::info('####### PROCESSING EVENT #######: ' . $event::class, [
            'id'       => $event->getAggregateId()->toString(),
            'email'    => $event->getEmail()->toString(),
            'name'     => $event->getName()->toString(),
            'password' => $event->getPassword()->toString(),
        ]);
    }
} 