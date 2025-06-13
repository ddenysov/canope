<?php
declare(strict_types=1);

namespace Zinc\Core\Http\Resource;

use JsonSerializable;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Support\Url\Url;

abstract class AbstractResource implements JsonSerializable
{
    protected array $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    #[\Override] public function jsonSerialize(): mixed
    {
        return $this->__invoke();
    }

    public function __invoke(): array
    {
        Logger::debug(json_encode($_SERVER, JSON_PRETTY_PRINT));

        return [
            'type'       => $this->getType(),
            'id'         => (string) $this->data['id'],
            'attributes' => $this->mapAttributes($this->data),
            'links'      => [
                'self'   => Url::to('view/' . $this->data['id']),
            ],
        ];
    }

    abstract function getType(): string;

    //abstract function getUrl(): string;
}