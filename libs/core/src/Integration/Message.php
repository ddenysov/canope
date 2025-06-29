<?php
declare(strict_types=1);

namespace Zinc\Core\Integration;

class Message implements MessageInterface
{
    public function __construct(protected MessagePayload $payload, protected MessageChannel $channel)
    {
    }

    public function getPayload(): MessagePayload
    {
        return $this->payload;
    }

    public function getChannel(): MessageChannel
    {
        return $this->channel;
    }
}