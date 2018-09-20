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

namespace Galactium\Space\Translation\Adapter;


use Galactium\Space\Translation\Exception;
use Phalcon\Translate\Adapter;
use Phalcon\Translate\AdapterInterface;

class NestedArray extends Adapter implements \JsonSerializable, AdapterInterface
{
    /**
     * @var array|mixed
     */
    protected $translate = [];

    /**
     * NestedArray constructor.
     * @param array $options
     * @throws Exception
     */
    public function __construct(array $options)
    {
        parent::__construct($options);

        if (!array_key_exists('content', $options)) {
            throw new Exception("Translation content was not provided");
        }

        $data = $options['content'];

        if (!is_array($data)) {
            throw new Exception("Translation data must be an array");
        }

        $this->translate = $data;
    }

    /**
     * @param string $index
     * @param null $placeholders
     * @return string
     */
    public function query($index, $placeholders = null)
    {
        $translation = $this->path($index, $this->translate);

        return $this->replacePlaceholders($translation, $placeholders);
    }

    /**
     * @param $key
     * @param $translate
     * @return string
     */
    protected function path(string $key, array $translate): string
    {
        if (array_key_exists($key, $translate)) {
            return $translate[$key];
        }

        if (strpos($key, '.') === false) {
            return $translate[$key] ?? $key;
        }

        foreach (explode('.', $key) as $part) {

            if (is_array($translate) && array_key_exists($part, $translate)) {
                $translate = $translate[$part];
            } else {
                return $key;
            }
        }
        return $translate;

    }

    /**
     * @param string $index
     * @return bool
     */
    public function exists($index)
    {
        return $this->path($index, $this->translate) === $index ? false : true;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->translate;
    }


}