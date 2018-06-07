<?php
/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */


namespace Galactium\Space\Helpers;

use Phalcon\Di;
use Phalcon\Text;

/**
 * Inspired by illuminate/support package.
 * @see https://github.com/illuminate/support
 */

if (!function_exists('Galactium\Space\Helpers\container')) {
    /**
     * @param mixed
     * @return mixed|\Phalcon\DiInterface
     */
    function container()
    {
        $default = Di::getDefault();
        $args = func_get_args();
        if (empty($args)) {
            return $default;
        }

        return call_user_func_array([$default, 'get'], $args);
    }
}


if (!function_exists('\Galactium\Space\Helpers\value')) {

    /**
     * @param $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof \Closure ? $value() : $value;
    }
}

if (!function_exists('Galactium\Space\Helpers\env')) {

    /**
     * @param string $key
     * @param null $default
     * @return array|bool|false|mixed|null|string
     */
    function env(string $key, $default = null)
    {
        $value = \getenv($key);
        if ($value === false) {
            return value($default);
        }
        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }
        return $value;
    }
}

if (!function_exists('Galactium\Space\Helpers\arrayGet')) {
    /**
     * @param array $array
     * @param string $key
     * @param null $default
     * @return array|mixed
     */
    function arrayGet(array $array, string $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        if (arrayHas($array, $key)) {
            return $array[$key];
        }
        if (strpos($key, '.') === false) {
            return $array[$key] ?? value($default);
        }
        foreach (explode('.', $key) as $segment) {
            if ((is_array($array) || $array instanceof \ArrayAccess) && arrayHas($array, $segment)) {
                $array = $array[$segment];
            } else {
                return value($default);
            }
        }
        return $array;
    }
}

if (!function_exists('Galactium\Space\Helpers\arrayHas')) {
    /**
     * @param array $array
     * @param array|string $keys
     * @return bool
     */
    function arrayHas(array $array, $keys): bool
    {
        if (is_null($keys)) {
            return false;
        }

        if ($keys === []) {
            return false;
        }

        $keys = (array)$keys;

        foreach ($keys as $key) {

            if ($array instanceof \ArrayAccess) {
                $result = $array->offsetExists($key);
            } else {
                $result = array_key_exists($key, $array);
            }

            if ($result) {
                continue;
            }

        }
        return true;

    }
}
if (!function_exists('Galactium\Space\Helpers\arraySet')) {
    /**
     * @param array $array
     * @param string $key
     * @param $value
     * @return array
     */
    function arraySet(array &$array, string $key, $value): array
    {
        if (is_null($key)) {
            return $array = $value;
        }
        $keys = explode('.', $key);
        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }
            $array = &$array[$key];
        }
        $array[array_shift($keys)] = $value;
        return $array;
    }
}


if (!function_exists('Galactium\Space\Helpers\uncamelize')) {

    /**
     * @param string $text
     * @return string
     */
    function uncamelize(string $text): string
    {
        return Text::uncamelize($text);
    }
}

if (!function_exists('Galactium\Space\Helpers\camelize')) {

    /**
     * @param string $text
     * @return string
     */
    function camelize(string $text): string
    {
        return Text::camelize($text);
    }
}