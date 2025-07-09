<?php
declare(strict_types=1);

namespace Denysov\UserService\Delivery\Http\Controller;

use Denysov\UserService\Application\Command\Ping\PingCommand;
use Denysov\UserService\Application\Command\User\RegisterUserCommand;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Zinc\Core\Domain\Value\Uuid;
use Zinc\Core\Http\Controller\AbstractCommandController;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Validator\CommandValidatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Zinc\Core\Command\CommandBusInterface;

class SignUpController extends AbstractCommandController
{
    #[\Override] protected function getCommand(): string
    {
        return RegisterUserCommand::class;
    }
}