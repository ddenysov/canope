<?php
declare(strict_types=1);

namespace Zinc\Core\Command;

abstract class AbstractCommand implements CommandInterface
{
    public string $id;

    final public function __construct(array $attributes = [])
    {
        foreach ($attributes as $name => $attribute) {
            if (is_null($attribute)) {
                continue;
            }
            // Проверяем, существует ли свойство в классе, прежде чем присваивать
            if (property_exists($this, $name)) {
                $this->$name = $attribute;
            }
        }
    }

    #[\Override] public function toArray(): array
    {
        return get_object_vars($this);
    }
}