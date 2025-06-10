<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

final class CollectionQuery
{
    public function __construct(
        public readonly string  $collection,     // Название read-таблицы / вьюхи
        public readonly int     $page = 1,       // Номер страницы (>=1)
        public readonly int     $perPage = 20,   // Записей на страницу
        /** @var array<string,string>  ['field' => 'ASC'|'DESC'] */
        public readonly array   $sort = [],
        public readonly ?string $search = null, // Поисковая строка
        /** @var array<string,mixed> произвольные фильтры, напр. ['status' => 'active'] */
        public readonly array   $filters = [],
    ) {
    }
}
