<?php

namespace Zinc\Core\Query;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): array;
}