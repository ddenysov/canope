<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Response\Resource;


class PingResource
{
    public function __construct(private array $data)
    {
    }

    public function __invoke(): array
    {
        return  [
            'type'       => 'pingR',
            'id'         => (string) $this->data['id'],
            'attributes' => $this->mapAttributes($this->data),
            'links' => [
                'self'  => 'http://localhost:8280/view/' . $this->data['id'],
            ],
        ];
    }

    protected function mapAttributes(array $item): array
    {
        return [
            'email' => $item['email'],
        ];
    }
}