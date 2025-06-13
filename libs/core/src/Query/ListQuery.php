<?php
declare(strict_types=1);

namespace Zinc\Core\Query;


use Zinc\Core\Support\JsonApi\JsonApiListQueryFactoryInterface;

class ListQuery implements JsonApiListQueryFactoryInterface, QueryInterface
{
    /**
     * @var int|null page[number] — номер страницы (начиная с 1)
     */
    public ?int $pageNumber = 1;

    /**
     * @var int|null page[size] — количество элементов на страницу
     */
    public ?int $pageSize = 25;

    /**
     * @var string|null sort — сортировка по одному или нескольким полям через запятую.
     * Пример: sort=-created_at,name
     * где "-" означает DESC
     */
    public ?string $sort = null;

    /**
     * @var array<string, mixed> filter — произвольные фильтры.
     * Пример: filter[status]=active
     */
    public array $filter = [];

    /**
     * @var string|null filter[search] — фильтр по поисковой строке (если используешь)
     */
    public ?string $search = null;

    #[\Override] public static function fromJsonApiArray(array $array): static
    {
        $instance             = new static();
        $instance->pageNumber = isset($array['page']['number']) ? (int) $array['page']['number'] : 1;
        $instance->pageSize   = isset($array['page']['size']) ? (int) $array['page']['size'] : 10;

        return $instance;
    }

    #[\Override] public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }

    public function getOffset(): int
    {
        return ($this->pageSize * ($this->pageNumber - 1));
    }
}
