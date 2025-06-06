<?php
declare(strict_types=1);

namespace Zinc\Core\Validator;

use Zinc\Core\Support\Array\AsArray;

class ValidationResult implements AsArray
{
    public $status = 200;

    public array $errors = [];

    /**
     * @param int $status
     * @param array $errors
     */
    public function __construct(int $status, array $errors)
    {
        $this->status = $status;
        $this->errors = $errors;
    }

    #[\Override] public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function valid(): bool
    {
        return count($this->errors) === 0;
    }
}