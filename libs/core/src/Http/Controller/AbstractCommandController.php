<?php
declare(strict_types=1);

namespace Zinc\Core\Http\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zinc\Core\Command\CommandBusInterface;
use Zinc\Core\Logging\Logger;
use Zinc\Core\Validator\CommandValidatorInterface;

abstract class AbstractCommandController
{
    public function __construct(
        protected CommandValidatorInterface $validator,
        protected CommandBusInterface       $bus
    ) {
    }

    public function __invoke(Request $request)
    {
        return $this->handleRequest($request);
    }

    protected function handleRequest(Request $request, ?\Closure $success = null): JsonResponse
    {
        $commandClass = $this->getCommand();
        $command      = new $commandClass($request->getPayload()->all());
        Logger::debug('Received command', [
            'class' => $commandClass,
        ]);
        $validator    = $this->getValidator();
        $result       = $validator->validate($command);

        if (!$result->valid()) {
            return new JsonResponse([
                'errors' => $result->errors,
            ], $result->status);
        }
        $commandBus = $this->getBus();
        $commandBus->dispatch($command);

        if ($success) {
            $success($command);
        }

        return new JsonResponse([], Response::HTTP_OK);
    }

    abstract protected function getCommand(): string;

    public function getValidator(): CommandValidatorInterface
    {
        return $this->validator;
    }

    public function getBus(): CommandBusInterface
    {
        return $this->bus;
    }
}