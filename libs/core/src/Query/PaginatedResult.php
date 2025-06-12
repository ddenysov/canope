<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

final class PaginatedResult
{
    /** @param list<array> $items */
    public function __construct(
        public readonly array $items,
        public readonly int   $total,
    )
    {
    }
}
