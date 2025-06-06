<?php
declare(strict_types=1);

namespace Zinc\Core\Validator\Symfony;

use Symfony\Component\Validator\Validator\ValidatorInterface;
use Zinc\Core\Command\CommandInterface;
use Zinc\Core\Validator\CommandValidatorInterface;
use Zinc\Core\Validator\ValidationResult;

class CommandValidator implements CommandValidatorInterface
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(CommandInterface $command): ValidationResult
    {
        $violations = $this->validator->validate($command);
        $errors = [];

        foreach ($violations as $violation) {
            $field = $violation->getPropertyPath();
            $errors[$field][] = $violation->getMessage();
        }

        return new ValidationResult(
            status: count($errors) > 0 ? 422 : 200,
            errors: $errors,
        );
    }
}