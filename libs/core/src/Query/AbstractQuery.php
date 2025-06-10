<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

use Zinc\Core\Query\QueryInterface;

abstract class AbstractQuery implements QueryInterface
{
    public string $id;

    final public function __construct(array $attributes = [])
    {
        foreach ($attributes as $name => $attribute) {
            if (is_null($attribute)) {
                continue;
            }
            $this->$name = $attribute;
        }
    }

    #[\Override] public function toArray(): array
    {
        return get_object_vars($this);
    }
}