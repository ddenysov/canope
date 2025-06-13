<?php
declare(strict_types=1);

namespace Zinc\Core\Http\Resource;

use JsonSerializable;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Query\ListQuery;
use Zinc\Core\Query\PaginatedResult;
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
        return [
            'type'       => $this->getType(),
            'id'         => (string) $this->data['id'],
            'attributes' => $this->mapAttributes($this->data),
            'links'      => [
                'self'   => $this->getUrl() . '/' . $this->data['id'],
            ],
        ];
    }

    public static function collection(ListQuery $query, PaginatedResult $result): ResourceCollection
    {
        return new ResourceCollection(static::class, $query, $result);
    }

    abstract public function getType(): string;
    abstract public function getUrl(): string;
}