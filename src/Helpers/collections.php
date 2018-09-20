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

/**
 * Inspired by illuminate/support package.
 * @see https://github.com/illuminate/support
 */

namespace Galactium\Space\Helpers;

if (!function_exists('Galactium\Space\Helpers\groupBy')) {
    /**
     * @param iterable $iterable
     * @param $key
     * @return array
     */
    function groupBy(iterable $iterable, $key): array
    {
        if (!is_string($key) && !is_int($key) && !is_callable($key)) {
            throw new \InvalidArgumentException('groupBy(): The key should be a string, sn integer or a function.');
        }

        $isFunction = $key instanceof \Closure;

        $grouped = [];
        foreach ($iterable as $value) {
            if ($isFunction) {
                $groupKey = $key($value);
            } else if (is_object($value)) {
                $groupKey = $value->{$key};
            } else {
                $groupKey = $value[$key];
            }

            $grouped[$groupKey][] = $value;
        }

        return $grouped;
    }
}