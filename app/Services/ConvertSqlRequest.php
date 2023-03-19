<?php
namespace App\Services;

use function preg_replace;
use function str_replace;

class ConvertSqlRequest
{
    const STRING_REPLACE = 'search_replace';

    /**
     * @param string $request
     * @param array $bindings
     * @return string
     */
    public static function convertBindings(string $request, array $bindings): string
    {
        // On remplace les ? de PDO par la const STRING_REPLACE afin d'éviter tout conflit avec un paramètre pouvant contenir un ?
        $request = str_replace('?', self::STRING_REPLACE, $request);

        foreach ($bindings as $binding) {
            $request = preg_replace('/'.self::STRING_REPLACE.'/', $binding, $request, 1);
        }

        return $request;
    }

    /**
     * @param mixed $query
     * @param int $page
     * @param int $perPage
     * @return string
     */
    public static function generateLimit($query, int $page, int $perPage): string
    {
        $sql = clone $query;
        $sql->skip(($page - 1) * $perPage);
        $sql->take($perPage);

        return $sql->toSql();
    }
}
