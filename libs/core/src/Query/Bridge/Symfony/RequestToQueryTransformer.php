<?php
declare(strict_types=1);

namespace Zinc\Core\Query\Bridge\Symfony;

use Denysov\UserService\Application\Query\FindPingQuery;
use Symfony\Component\HttpFoundation\Request;
use Zinc\Core\Query\QueryInterface;

class RequestToQueryTransformer
{
    public static function transform(Request $request, string $queryClass): QueryInterface
    {
        if (!is_subclass_of($queryClass, QueryInterface::class)) {
            throw new \InvalidArgumentException(
                sprintf('%s must implement %s', $queryClass, QueryInterface::class)
            );
        }

        parse_str($request->getQueryString(), $queryParams);

        $vars = array_keys(get_class_vars($queryClass));

        $attrs = [];
        foreach ($vars as $var) {
            if (!isset($queryParams[$var])) {
                continue;
            }
            $attrs[$var] = $queryParams[$var];
        }

        return new FindPingQuery($attrs);
    }
}