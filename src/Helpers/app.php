<?php
/**
 * Copyright (c) 2018. Grigoriy Ivanov
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

/**
 * Galactium @ 2018
 * @author Grigoriy Ivanov
 */

namespace Galactium\Space\Helpers;

use Phalcon\Di;
use Phalcon\Text;


if (!function_exists('Galactium\Space\Helpers\container')) {
    /**
     * @param null $service
     * @param array $params
     * @return mixed|\Phalcon\DiInterface
     */
    function container($service = null, $params = [])
    {
        $di = Di::getDefault();
        $args = func_get_args();
        if (empty($args)) {
            return $di;
        }
        return $di->get($service, $params);
    }
}


if (!function_exists('Galactium\Space\Helpers\uncamelize')) {
    /**
     * @param string $text
     * @param null $delimiter
     * @return string
     */
    function uncamelize(string $text, $delimiter = null): string
    {
        return Text::uncamelize($text, $delimiter);
    }
}

if (!function_exists('Galactium\Space\Helpers\camelize')) {
    /**
     * @param string $text
     * @param null $delimiter
     * @return string
     */
    function camelize(string $text, $delimiter = null): string
    {
        return Text::camelize($text, $delimiter);
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