<?php
declare(strict_types=1);

namespace Zinc\Core\Messaging\Symfony\RoadRunner;

use DateTimeImmutable;
use Spiral\Goridge\RPC\RPC;
use Spiral\RoadRunner\Jobs\Jobs;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;
use Symfony\Component\Messenger\Transport\TransportInterface;
use Symfony\Component\Uid\Uuid;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Messaging\Symfony\Serializer\CloudEventSerializer;
use Zinc\Core\Support\Serializer\SimpleSerializer;

class RoadRunnerTransport implements TransportInterface
{
    private Jobs $jobs;

    public function __construct(private CloudEventSerializer $serializer)
    {
        $this->jobs = new Jobs(
        // Expects RPC connection
            RPC::create('tcp://127.0.0.1:6001')
        );
        Logger::debug('Transport created');
    }

    #[\Override] public function get(): iterable
    {
        Logger::info('GET MESSAGE');

        return [];
    }

    #[\Override] public function ack(Envelope $envelope): void
    {
        Logger::info('ACK');
    }

    #[\Override] public function reject(Envelope $envelope): void
    {
        Logger::info('REJECT');
    }

    #[\Override] public function send(Envelope $envelope): Envelope
    {
        $uuid = (string) Uuid::v4();
        Logger::info('SEND', [
            'envelope' => $envelope->all(),
            'message'  => $envelope->getMessage(),
            'type'     => get_class($envelope->getMessage()),
        ]);
        $queue = $this->jobs->connect('demo-queue');

        $message      = $envelope->getMessage();
        $messageClass = $message::class;

        $payload = [
            'id'   => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'type' => $messageClass,
            'data' => SimpleSerializer::toJson($message),
            'time' => (new DateTimeImmutable()),
        ];

        $task = $queue->create(
            get_class($envelope->getMessage()),
            payload: \json_encode($payload)
        );
        $queue->dispatch($task);

        Logger::debug('TASK SENT', [
            'task' => $task,
        ]);

        return $envelope->with(new TransportMessageIdStamp($uuid));
    }
}