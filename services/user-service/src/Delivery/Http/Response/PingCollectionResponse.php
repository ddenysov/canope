<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Response;

use Zinc\Core\Http\Response\JsonApiCollectionResponse;

class PingCollectionResponse extends JsonApiCollectionResponse
{
    #[\Override] protected function mapAttributes(array $item): array
    {
        return [
            'email' => $item['email'],
        ];
    }

    #[\Override] protected function getType(): string
    {
        return 'ping';
    }

}