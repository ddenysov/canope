<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Response;

use Denysov\UserService\Delivery\Http\Response\Resource\PingResource;
use Zinc\Core\Http\Response\JsonApiCollectionResponse;

class PingCollection extends JsonApiCollectionResponse
{
    #[\Override] protected function getResource(): string
    {
        return PingResource::class;
    }
}