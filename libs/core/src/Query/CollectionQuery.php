<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

final class CollectionQuery
{
    public function __construct(
        public readonly string  $collection,
        public readonly int     $page = 1,
        public readonly int     $perPage = 20,
        public readonly array   $sort = [],
        public readonly ?string $search = null,
        public readonly array   $filters = [],
    ) {
    }
}
