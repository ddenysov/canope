<?php

namespace Zinc\Core\Integration;

interface MessagePublisherInterface
{
    public function publish(
        MessageInterface $message,
        \Closure $onSuccess = null,
        \Closure $onFail = null,
    ): void;
}