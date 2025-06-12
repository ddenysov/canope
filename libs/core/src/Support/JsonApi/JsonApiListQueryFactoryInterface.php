<?php
declare(strict_types=1);

namespace Zinc\Core\Support\JsonApi;

interface JsonApiListQueryFactoryInterface
{
    public static function fromJsonApiArray(array $array): static;
}