<?php

namespace Zinc\Core\Validator;

use Zinc\Core\Command\CommandInterface;

interface CommandValidatorInterface
{
    public function validate(CommandInterface $command): ValidationResult;
}