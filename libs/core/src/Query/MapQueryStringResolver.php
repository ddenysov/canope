<?php
declare(strict_types=1);

namespace Zinc\Core\Query;

use ReflectionClass;
use ReflectionNamedType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Zinc\Core\Support\JsonApi\JsonApiListQueryFactoryInterface;

class MapQueryStringResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $queryClass = $argument->getType();

        if (!class_exists($queryClass)) {
            throw new \InvalidArgumentException("Class $queryClass does not exist");
        }

        $params = $request->query->all();
        $query  = new $queryClass();

        if ($query instanceof JsonApiListQueryFactoryInterface) {
            yield $queryClass::fromJsonApiArray($params);
        } else {
            $reflection = new ReflectionClass($query);

            foreach ($params as $key => $value) {
                if (!$reflection->hasProperty($key)) {
                    continue;
                }

                $property = $reflection->getProperty($key);
                if (!$property->isPublic()) {
                    continue;
                }
                $type = $property->getType();
                if ($type instanceof ReflectionNamedType) {
                    $typeName = $type->getName();
                    settype($value, $typeName);
                }
                $query->$key = $value;
            }

            yield $query;
        }
    }
}