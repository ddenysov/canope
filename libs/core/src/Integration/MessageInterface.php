<?php

namespace Zinc\Core\Integration;

interface MessageInterface
{
    public function getChannel(): MessageChannel;

    public function getPayload(): MessagePayload;
}