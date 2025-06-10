<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

final class PaginatedResult implements \JsonSerializable
{
    /** @param list<array> $items */
    public function __construct(
        public readonly array $items,
        public readonly int   $total,   // всего строк
        public readonly int   $page,    // текущая страница
        public readonly int   $perPage, // размер страницы
    ) {}

    public function jsonSerialize(): array
    {
        return [
            'data'  => $this->items,
            'meta'  => [
                'total'    => $this->total,
                'page'     => $this->page,
                'per_page' => $this->perPage,
                'pages'    => (int)ceil($this->total / $this->perPage),
            ],
        ];
    }
}
