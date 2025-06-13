<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Response\Resource;


use Zinc\Core\Http\Resource\AbstractResource;
use Zinc\Core\Support\Url\Url;

class PingResource extends AbstractResource
{
    #[\Override] public function getType(): string
    {
        return 'ping';
    }


    protected function mapAttributes(array $item): array
    {
        return [
            'email' => $item['email'],
        ];
    }

    #[\Override] public function getUrl(): string
    {
        return Url::to('view');
    }
}