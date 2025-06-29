<?php
declare(strict_types=1);

namespace Zinc\Core\Integration\Message;

use CloudEvents\Serializers\JsonSerializer;
use CloudEvents\V1\CloudEvent;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Zinc\Core\Integration\Message;
use Zinc\Core\Integration\MessagePayload;

class CloudEventMessage extends Message
{
    public function getPayload(): MessagePayload
    {
        $event = new CloudEvent(
            id: Uuid::uuid4()->toString(),
            source: 'TBD',
            type: 'UNKNOWN',
            data: $this->payload,
            time: (new DateTimeImmutable()),
            extensions: []
        );
        $payload = JsonSerializer::create()->serializeStructured($event);

        return new MessagePayload(json_decode($payload, true));
    }
}