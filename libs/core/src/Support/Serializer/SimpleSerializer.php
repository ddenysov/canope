<?php
declare(strict_types=1);

namespace Zinc\Core\Support\Serializer;

class SimpleSerializer
{
    /**
     * Берёт все публичные методы вида getXxx() и собирает массив ['xxx_xxx' => значение].
     */
    public static function toJson(object $object): string
    {
        $data = [];

        foreach (get_class_methods($object) as $method) {
            if (str_starts_with($method, 'get') && strlen($method) > 3) {
                // имя свойства в camelCase, например "firstName"
                $property = lcfirst(substr($method, 3));

                // конвертация в snake_case: firstName → first_name
                $snakeKey = strtolower(
                    preg_replace('/([A-Z])/', '_$1', $property)
                );

                $value = $object->$method();
                if (is_scalar($value)) {
                    $data[$snakeKey] = $value;
                } else {
                    $data[$snakeKey] = $value->toString();
                }

            }
        }

        $attrs  = self::objectToArray($object);
        $result = array_merge_recursive($data, $attrs);

        return json_encode($result, JSON_THROW_ON_ERROR);
    }

    /**
     * Десериализация в объект класса $className.
     * Конструктор класса должен принимать один аргумент — массив $data.
     *
     * @param string $json JSON-строка
     * @param string $className Полное имя класса, конструктор которого __construct(array $data)
     * @return object
     */
    public static function fromJson(string $json, string $className): object
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        if (method_exists($className, 'fromArray')) {
            return $className::fromArray(self::arrayKeysSnakeToCamel($data));
        }

        return new $className(self::arrayKeysSnakeToCamel($data));
    }

    private static function toSnakeCase(string $input): string
    {
        // вставляем подчёркивание перед заглавной буквой и приводим к нижнему регистру
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $input));
    }

    private static function snakeToCamel(string $string): string {
        // заменяем подчёрки на пробелы, делаем ucwords, убираем пробелы и приводим первый символ к нижнему регистру
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }

    public static function arrayKeysSnakeToCamel(array $input): array {
        $result = [];
        foreach ($input as $key => $value) {
            $newKey = self::snakeToCamel($key);
            $result[$newKey] = $value;
        }
        return $result;
    }

    /**
     * Преобразует объект в ассоциативный массив со snake_case-ключами
     */
    private static function objectToArray(object $obj): array
    {
        $vars   = get_object_vars($obj);
        $result = [];

        foreach ($vars as $prop => $value) {
            $key = self::toSnakeCase($prop);

            // если нужно рекурсивно обрабатывать вложенные объекты/массивы
            if (is_object($value)) {
                $value = self::objectToArray($value);
            } elseif (is_array($value)) {
                $value = array_map(function ($item) {
                    return is_object($item) ? self::objectToArray($item) : $item;
                }, $value);
            }

            $result[$key] = $value;
        }

        return $result;
    }
}