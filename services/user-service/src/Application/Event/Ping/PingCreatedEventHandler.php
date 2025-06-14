<?php
declare(strict_types=1);

namespace Denysov\UserService\Application\Event\Ping;

use Denysov\UserService\Domain\Model\Ping\Event\PingCreated;
use Zinc\Core\DataStore\DataStoreInterface;
use Zinc\Core\Event\EventHandlerInterface;
use Zinc\Core\Logging\Logger;

class PingCreatedEventHandler implements EventHandlerInterface
{

    public function __construct(private DataStoreInterface $store)
    {
    }

    public function __invoke(PingCreated $event)
    {
        $res = $this->store->find('event_store');

        $this->store->insert('read_model_users', [
            'id' => $event->getAggregateId()->toString(),
            'email' => md5((string) rand(1, 999999)) . '@gmail.com'
        ]);

        Logger::info('####### PROCESSING EVENT #######: ' . $event::class, [
            'id' => $event->getAggregateId()->toString(),
            'res' => $res,
        ]);
    }
}