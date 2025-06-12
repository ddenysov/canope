<?php

namespace Zinc\Core\Query;

interface ListQueryHandlerInterface
{
    public function __invoke(ListQuery $query): PaginatedResult;
}