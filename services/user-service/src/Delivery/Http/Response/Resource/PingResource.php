<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Response\Resource;


use JsonSerializable;
use Zinc\Core\Http\Resource\AbstractResource;

class PingResource extends AbstractResource
{
    #[\Override] function getType(): string
    {
        return 'ping';
    }


    protected function mapAttributes(array $item): array
    {
        return [
            'email' => $item['email'],
        ];
    }
}