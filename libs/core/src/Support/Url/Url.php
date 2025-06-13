<?php
declare(strict_types=1);

namespace Zinc\Core\Support\Url;

class Url
{
    public static function to(string $path, array $params = []): string
    {
        $queryString = '';
        if (!empty($params)) {
            $queryString = '?' . http_build_query($params);
        }

        return self::host() . '/' . $path . $queryString;
    }

    public static function host(): string
    {
        if (isset($_SERVER['APP_URL']) && $_SERVER['APP_URL']) {
            $baseUrl = $_SERVER['APP_URL'];
        } else {
            $parts   = parse_url($_SERVER['REQUEST_URI']);
            $baseUrl = $parts['scheme'] . '://' . $parts['host'] . (isset($parts['port']) ? ':' . $parts['port'] : '');

            if (isset($_SERVER['HTTP_X_FORWARDED_PREFIX'])) {
                $baseUrl = $baseUrl . $_SERVER['HTTP_X_FORWARDED_PREFIX'];
            }
        }

        return $baseUrl;
    }

    public static function path(array $params = []): string
    {
        $queryString = '';
        if (!empty($params)) {
            $queryString = '?' . http_build_query($params);
        }
        $url = $_SERVER['REQUEST_URI'];
        $parts = parse_url($url);

        if (isset($parts['port'])) {
            $parts['host'] = $parts['host'] . ':' . $parts['port'];
        }

        return implode('', [
            self::host(),
            $parts['path'],
            $queryString
        ]);
    }
}